<?php
$sc = $_SESSION['cuid'];
$_SERVER['DOCUMENT_ROOT'] = '/var/www/why';
$res = $dbc->query("SELECT projects.id,files.cuid,files.name FROM projects JOIN files ON projects.photo = files.id WHERE projects.id = 79");
while($r = $res->fetch_assoc()) {
	print_r($r);
	echo "<br/>";
	$file = explode(".",$r['name']);
	$_SESSION['cuid'] = $r['cuid'];
	make_thumb($r['name'],"500",$file[1],$file[0]."_.".$file[1]);
}
$_SESSION['cuid'] = $sc;