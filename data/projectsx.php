<?php
$entries = 3;
$res = $dbc->query("SELECT * FROM projects WHERE ranking>0");
while($r = $res->fetch_assoc()) {
	$json[] = $r;
	$weight[] = rand(0,10)*$r['ranking'];
}
array_multisort($weight, SORT_DESC ,$json);
echo htmlspecialchars(json_encode(array_slice($json,0,$entries)));