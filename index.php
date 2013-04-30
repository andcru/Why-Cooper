<?php
session_start();
$er = 0;

if($er) {error_reporting( E_ALL ); ini_set('display_errors', '1');}

include( dirname(__FILE__) . '/config.php' );
include( dirname(__FILE__) . '/fns.php' );
include( dirname(__FILE__) . '/../common/class_student.php' );
include( dirname(__FILE__) . '/auth.php' );

if(substr($_GET['p'],-1,1) != 'x') {
	include( dirname(__FILE__) . '/header.php' );
	$folder = "pages";
}
elseif($pg[0] != 'data')
	$folder = "exec";

if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/'.$_GET['p'].'.php'))
	include_once($_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/'.$_GET['p'].'.php');
else
	include_once($_SERVER['DOCUMENT_ROOT'].'/dne.php');

if(substr($_GET['p'],-1,1) != 'x')
	include( dirname(__FILE__) . '/footer.php' );