<?php
$limit = 50;
$entries = isset($_GET['limit']) ? min($_GET['limit'],$limit) : $limit;
$res = $dbc->query("SELECT * FROM press WHERE ranking>0 ORDER BY pub_date DESC, ranking DESC LIMIT {$entries}");
while($r = $res->fetch_assoc()) {
	$r['pub_date'] = date("F j, Y",strtotime($r['pub_date']));
	$news[] = $r;
	$sort[] = strtotime($r['pub_date']);
}
$res = $dbc->query("SELECT id,event AS title,club,details AS preview,req_id,starttime FROM events WHERE ranking>0 ORDER BY endtime DESC LIMIT {$entries}");
while($r = $res->fetch_assoc()) {
	$r['pub_date'] = date("F j, Y",strtotime($r['starttime']));
	$news[] = $r;
	$sort[] = strtotime($r['pub_date']);
}

array_multisort($sort, SORT_DESC ,$news);
$json['news'] = array_slice($news,0,$entries);

$res = $dbc->query("SELECT * FROM alumni WHERE ranking>0 ORDER BY ranking DESC,name");
while($r = $res->fetch_assoc())
	$json['alumni'][] = $r;


echo json_encode($json, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
