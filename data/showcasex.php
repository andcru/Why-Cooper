<?php
$entries = 12;
$res = $dbc->query("SELECT * FROM projects WHERE ranking>0");
while($r = $res->fetch_assoc()) {
	$r['school'] = (new student($r['cuid']))->school();
	$json[] = $r;
	$weight[] = rand(0,10)*$r['ranking'];
}
array_multisort($weight, SORT_DESC ,$json);
echo json_encode(array_slice($json,0,$entries), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);