<?php

$s = $_POST['query'];

$name = explode(" ",$s);

if(sizeof($name) == 2) {
	$name1 = $name[0];
	$name2 = $name[1];
	$qry = "SELECT fname,lname,cuid FROM jac.students WHERE (fname LIKE '%{$name1}%' AND lname LIKE '%{$name2}%') OR (fname LIKE '%".implode(" ",$name)."%')";
}
elseif(sizeof($name) > 2) {
	$name2 = $name[sizeof($name)-1];
	array_pop($name);
	$name1 = implode(" ",$name);
	$qry = "SELECT fname,lname,cuid FROM jac.students WHERE (fname LIKE '%{$name1}%' AND lname LIKE '%{$name2}%')";
}
elseif(sizeof($name) == 1) {
	$name1 = $name[0];
	$qry = "SELECT fname,lname,cuid FROM jac.students WHERE fname LIKE '%{$name1}%' OR lname LIKE '%{$name1}%' OR cuid LIKE '%{$name1}%'";
}
if($qry) {
	$res = $dbc->query($qry);
	if($res->num_rows&&$res->num_rows<=8) { 
		while($row = $res->fetch_assoc()) { 
			$suggestions[] = $row['fname']." ".$row['lname'];
			$cuid[] = $row['cuid'];
		}
	$json = array("query" => $s, "suggestions" => $suggestions, "cuid" => $cuid);
	echo json_encode($json);
	}
}