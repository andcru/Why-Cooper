<?php

$arr = @$_FILES['file'];

if(@$arr) {

	if ($arr["error"] > 0) {
		echo "Return Code: " . $arr["error"] . "<br />";
	}
	else {
		$arr['name'] = str_replace(" ","_",$arr['name']);
		$cnt = 0;
		if(substr_count($arr["name"], '.') > 1) {
			$ext = substr($arr['name'],strrpos($arr['name'],'.')+1);
			$name = substr($arr['name'],0,strrpos($arr['name'],'.'));
			$name = str_replace(".","",$name);
			$arr['name'] = $name.'.'.$ext;
		}
		$file = explode(".",$arr['name']);
		if($file[1] == 'jpeg') {
			$file[1] == 'jpg';
			$arr['name'] = $file[0].'.jpg';
		}
		while(file_exists($_SERVER["DOCUMENT_ROOT"].'/users/'.$_SESSION['cuid'].'/uploads/'.$arr["name"])) {
			$ext = substr($arr['name'],strrpos($arr['name'],'.')+1);
			$name = substr($arr['name'],0,strrpos($arr['name'],'.'));
			$name = $cnt ? substr($name,0,-1-floor(log10($cnt-floor(log10($cnt))))) : $name;
			$name .= $cnt;
			$arr['name'] = $name.'.'.$ext;
			$cnt++;
			}
		}

	move_uploaded_file($arr["tmp_name"],$_SERVER["DOCUMENT_ROOT"].'/users/'.$_SESSION['cuid'].'/uploads/'.$arr["name"]);
	chmod($_SERVER["DOCUMENT_ROOT"].'/users/'.$_SESSION['cuid'].'/uploads/'.$arr["name"],0755);

	$img_ext = array('jpg','png','gif','jpeg');

	$image = 0;
	if(in_array(strtolower($file[1]),$img_ext)) {
		make_thumb($arr['name'],'75',$file[1]);
		$size = getimagesize($_SERVER['DOCUMENT_ROOT'] . '/users/' . $_SESSION['cuid'] .'/uploads/' . $arr['name']);
		$sizes = ','.$size['0'].','.$size['1'];
		$image = 1;
	}

	$stmt = $dbc->prepare("INSERT INTO files (cuid,name,image) VALUES (?,?,?)");
	$stmt->bind_param('ssd',$_SESSION['cuid'],$arr['name'],$image);
	$stmt->execute();

	if(substr($_SERVER['HTTP_REFERER'],-5,1)=='m' && !$image) {
		die('This file is not an image... but we uploaded it anyway.');
	}

	if(!$cont) {
		$_SESSION['uploaded_file'] = $_SESSION['cuid'].'/uploads/'.$arr['name'].@$sizes;
		exit_yes('');
	}
}
else
	die('Upload_failed');