<?php

// Ensure you filled out all required fields
notblank($_POST);

if(!intval($_POST['year']) || $_POST['year'] > 2011 || $_POST['year'] < 1900)
	exit_no('Your graduation year must be between 1900 and 2011.');

if($_POST['pass1'] !== $_POST['pass2'])
	exit_no('Your passwords do not match.');

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	exit_no('You must enter a valid email address.');

if(strlen($_POST['cuid']) < 3)
	exit_no('Your username must be at least 3 characters long.');

if((new student($_POST['cuid']))->valid || dbexist('users','cuid',$_POST['cuid']))
	exit_no('The username "'.$_POST['cuid'].'" is already registered.');

$pass = hash('sha256', $_POST['pass1']);

$qry = "INSERT INTO users (cuid,password,email) VALUES (?,?,?)";
$stmt = $dbc->prepare($qry);
$stmt->bind_param('sss',$_POST['cuid'],$pass,$_POST['email']);
if(!$stmt->execute())
	exit_no('Execution failed: ('.$stmt->errno.') '.$stmt->error);

$cuid = "_".$stmt->insert_id;

$qry = "INSERT INTO jac.students (fname,lname,cuid,major,year,section) VALUES (?,?,?,?,?,0)";
$stmt = $dbc->prepare($qry);
$stmt->bind_param('sssdd',$_POST['fname'],$_POST['lname'],$cuid,$_POST['major'],$_POST['year']);
if(!$stmt->execute())
	exit_no('Execution failed: ('.$stmt->errno.') '.$stmt->error);

exit_yes('You have successfully registered!','/login');