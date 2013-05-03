<?php
$limit = 50;
$entries = isset($_GET['limit']) ? min($_GET['limit'],$limit) : $limit;
$res = $dbc->query("SELECT * FROM experiences WHERE ranking>0");
while($r = $res->fetch_assoc()) {
	$json[] = $r;
	$weight[] = rand(0,10)*$r['ranking'];
}

array_multisort($weight, SORT_DESC ,$json);
$json = array_slice($json,0,$entries);

foreach($json as $key => $val) {
	$stud = new student($val['cuid']);
	$json[$key]['student'] = $stud->name();
	$json[$key]['class'] = $stud->maj(1)." '".substr($stud->year,2);
}

echo json_encode($json, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
