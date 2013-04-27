<?php

// Ensure you filled out all required fields
notblank($_POST);

$login = @imap_open('{farley2.cooper.edu:993/imap/ssl/novalidate-cert}',$_POST['user'],$_POST['pass'],OP_HALFOPEN,1);

if(!$login)
	exit_no('Username and/or password invalid.');
else {
	session_regenerate_id();
	$_SESSION['cuid'] = $_POST['user'];
	header("location: /admin/home");
}