<?php

$res = $dbc->query("SELECT projects.id,title,projects.cuid,name AS photo,members,ranking FROM projects JOIN files ON projects.photo = files.id WHERE ranking>0");
while($r = $res->fetch_assoc()) {
	$r['members'] = $r['members'] ? explode(",",$r['members']) : "";
	$json[] = $r;
	$weight[] = rand(0,10)*$r['ranking'];
}
array_multisort($weight, SORT_DESC ,$json);
$json = array_slice($json,0,$entries);

foreach($json as $key => $val) {
	$stud = new student($val['cuid']);
	$json[$key]['school'][] = $stud->maj(1);
	$json[$key]['student'] = $stud->name().' ('.$stud->maj(0,0,1)." '".substr($stud->year,2).')';
	if(is_array($val['members'])) {
		foreach($val['members'] as $cuid) {
			$stud = new student($cuid);
			$json[$key]['mems'][] = $stud->name().' ('.$stud->maj(0,0,1)." '".substr($stud->year,2).')';
			if(!in_array($stud->maj(1),$json[$key]['school']))
				$json[$key]['school'][] = $stud->maj(1);
		}
	}
}
echo json_encode($json);
