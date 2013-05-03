<?php

// Ensure you filled out all required fields
notblank($_POST);

$login = @imap_open('{farley2.cooper.edu:993/imap/ssl/novalidate-cert}',$_POST['user'],$_POST['pass'],OP_HALFOPEN,1);

if(!$login)
	exit_no('Username and/or password invalid.');
else {
	$stud = new student($_POST['user']);
	if(!$stud->valid) {
		die('You have successfully logged in but are not in our database. Please login at <a href="https://jac.cooper.edu/login">https://jac.cooper.edu/login</a>, register in our database, and try again!');
	}
	session_regenerate_id();
	$_SESSION['cuid'] = strtolower($_POST['user']);
	createfolders();
	header("location: /admin/home");
}