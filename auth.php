<?php

$pg = explode("/",$_GET['p']);
if(is_numeric($pg[sizeof($pg)-1])) {
	$pg_id = array_pop($pg);
	$_GET['p'] = implode("/",$pg);
}
if(!$pg[0])
	$_GET['p'] = 'home';

// Check if they are in a bad area
if($pg[0] == 'admin' && !isset($_SESSION['cuid'])) {
	$_SESSION['msg']['err'] = array('You must be logged in to see this page.');
	header('location: /login');
	die();
}

if($_SESSION['cuid'])
	$me = new student($_SESSION['cuid']);
