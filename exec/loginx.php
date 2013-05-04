<?php

// Ensure you filled out all required fields
notblank($_POST);

$res = $dbc->query("SELECT password FROM users WHERE cuid='{$_POST['user']}'");
if($res->num_rows == 1) {
	$pass = hash('sha256', $_POST['pass']);
	$row = $res->fetch_assoc();
	if($pass === $row['password']) {
		$login = 1;
		$_POST['user'] = "_".$_POST['user'];
	}
}
if(!$login)
	$login = @imap_open('{farley2.cooper.edu:993/imap/ssl/novalidate-cert}',$_POST['user'],$_POST['pass'],OP_HALFOPEN,1);

if(!$login)
	exit_no('Username and/or password invalid.');
else {
	$stud = new student($_POST['user']);
	if(!$stud->valid)
		exit_no('You have successfully logged in but are not in our database. Please login at <a href="https://jac.cooper.edu/login">https://jac.cooper.edu/login</a>, register in our database, and try again!');
	session_regenerate_id();
	$_SESSION['cuid'] = strtolower($_POST['user']);
	createfolders();
	header("location: /admin/home");
}