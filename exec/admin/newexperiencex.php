<?php

$r = $_POST;

notblank($r);

$qry = "INSERT INTO experiences (cuid,experience) VALUES (?,?)";
$stmt = $dbc->prepare($qry);
$stmt->bind_param('ss',$_SESSION['cuid'],$r['experience']);
if(!$stmt->execute())
	exit_no('Execution failed: ('.$stmt->errno.') '.$stmt->error);

exit_yes('Experience added successfully!');