<?php
notblank($_POST);

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	exit_no('You must enter a valid email address.');

$qry = "INSERT INTO emails (email) VALUES (?)";
$stmt = $dbc->prepare($qry);
$stmt->bind_param('s',$_POST['email']);
if(!$stmt->execute())
	exit_no('Execution failed: ('.$stmt->errno.') '.$stmt->error);

exit_yes('Email address "'.$_POST['email'].'" successfully added!');