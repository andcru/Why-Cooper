<?php
$entries = isset($_GET['limit']) ? min($_GET['limit'],12) : 12;
$res = $dbc->query("SELECT projects.id,title,projects.cuid,name AS photo,members,ranking FROM projects JOIN files ON projects.photo = files.id WHERE ranking>0");
while($r = $res->fetch_assoc()) {
	$json[] = $r;
	$weight[] = rand(0,10)*$r['ranking'];
}
array_multisort($weight, SORT_DESC ,$json);
$json = array_slice($json,0,$entries);

foreach($json as $key => $val) {
	$stud = new student($val['cuid']);
	$json[$key]['school'] = $stud->school();
	$json[$key]['student'] = $stud->name().' ('.$stud->maj(0,0,1).' '.$stud->year.')';
}
echo json_encode(array_slice($json,0,$entries), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);