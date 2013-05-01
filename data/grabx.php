<?php
$s = $_SESSION['cuid'];
$res = $dbc->query("SELECT projects.id,projects.cuid,name FROM projects JOIN files ON projects.photo = files.id WHERE projects.id = 8");
while($r = $res->fetch_assoc()) {
	$_SESSION['cuid'] = $r['cuid'];
	print_r($r);
	make_thumb2($r['name'],270,'png');
}
$_SESSION['cuid'] = $s;


function make_thumb2($src, $desired_width,$ext) {

	switch(strtolower($ext)) {
		case 'jpg':
		case 'jpeg':
			$create_fn = 'imagecreatefromjpeg';
			$save_fn = 'imagejpeg';
			break;
		case 'png':
			$create_fn = 'imagecreatefrompng';
			$save_fn = 'imagepng';
			break;
		case 'gif':
			$create_fn = 'imagecreatefromgif';
			$save_fn = 'imagegif';
			break;
	}

	$source_image = $create_fn( '/var/www/why/users/' . $_SESSION['cuid'] .'/uploads/' . $src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	$desired_height = floor($height * ($desired_width / $width));
	
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

	$file = explode(".",$src);
	
	$save_fn($virtual_image, '/var/www/why/users/' . $_SESSION['cuid'] .'/uploads/t/' . $file['0'] .'.'. $file['1']);
}