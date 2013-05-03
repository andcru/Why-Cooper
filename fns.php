<?php

function notblank($arr,$except='',$msg='') {
	GLOBAL $rdr;
	$rd = $red ? $red : $_SERVER['HTTP_REFERER'];
	foreach($arr as $key => $value) {
		if((!$value||$value==""||$value=="NULL")&&!@in_array($key,$except)) {
			$errmsg_arr[] = 'You must fill out all required fields';
			$_SESSION['msg']['err'] = $errmsg_arr;
			session_write_close();
			if(!$msg)
				header('location: '.$rd);
			else
				die($msg);
			exit();
		}
	}
}

function adderr($msg) {
	GLOBAL $errmsg_arr,$errflag;
	$errmsg_arr[] = $msg;
	$errflag = true;
}

function exit_no($msg='',$red='') {
	GLOBAL $rdr, $errflag,$errmsg_arr;
	$rd = $red ? $red : $_SERVER['HTTP_REFERER'];
	if($msg) {
		$errmsg_arr[] = $msg;
		$errflag = true;
	}
	if($errflag) {
		$_SESSION['msg']['err'] = $errmsg_arr;
		session_write_close();
		header('location: '.$rd);
		exit();
	}
}

function exit_yes($msg='',$red='') {
	GLOBAL $rdr;
	$rd = $red ? $red : $_SERVER['HTTP_REFERER'];
	$_SESSION['msg']['suc'][] = $msg;
	session_write_close();
	header('location: '.$rd);
	exit();
}

function make_thumb($src, $desired_width,$ext) {

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

	$source_image = $create_fn( $_SERVER['DOCUMENT_ROOT']. '/' . $_SESSION['cuid'] .'/uploads/' . $src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	$desired_height = floor($height * ($desired_width / $width));
	
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

	$file = explode(".",$src);
	
	$save_fn($virtual_image, $_SERVER['DOCUMENT_ROOT']. '/' . $_SESSION['cuid'] .'/uploads/t/' . $file['0'] .'.'. $file['1']);
}

function shrink($name,$ext,$desired_width,$desired_height) {

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

	$source_image = $create_fn($_SERVER['DOCUMENT_ROOT'].$name.'.'.$ext);
	$width = imagesx($source_image);
	$height = imagesy($source_image);

	$nam = explode("/",$name);
	$filename = @array_pop($nam);
	$path = implode("/",$nam);
	
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);		
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);	
	$save_fn($virtual_image, $_SERVER['DOCUMENT_ROOT'].$path.'/i/'.$filename.'_'.$desired_width.'x'.$desired_height.'.'.$ext);
}

function createfolders() {
	$user_root = dirname(__FILE__) . '/users/' . $_SESSION['cuid'] . '/';
	if(@!file_exists($user_root . 'uploads/i/')) {
		mkdir($user_root);
		mkdir($user_root . 'uploads/');
		mkdir($user_root . 'uploads/t/');
		mkdir($user_root . 'uploads/i/',0777);
	}
}