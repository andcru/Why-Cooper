<table>

<?php

$op = (substr($_SERVER['HTTP_REFERER'],-5,1)=='m') ? 'AND image = 1' : "";

$qry = "SELECT name,image FROM files WHERE cuid='{$_SESSION['cuid']}' {$op}";

$res = $dbc->query($qry);
while($row = $res->fetch_assoc()) {
	unset($sizes);
	if($row['image']) {
		$file = explode(".",$row['name']);
		$img = '/users/' . $_SESSION['cuid'] .'/uploads/t/' . $file['0'] .'.'. $file['1'];
		$size = getimagesize($_SERVER['DOCUMENT_ROOT'] . '/users/' . $_SESSION['cuid'] .'/uploads/' . $row['name']);
		$sizes = ','.$size['0'].','.$size['1'];
	}
	else 
		$img = '/img/file.png';
	echo "<tr id='{$_SESSION['cuid']}/uploads/{$row['name']}".@$sizes."' class='imgselect'><td><img src='{$img}'></td><td>{$row['name']}</td></tr>";
}
?>