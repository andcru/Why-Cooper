<?php

$r = $_POST;

notblank($r);

$qry = "INSERT INTO experiences (cuid,experience) VALUES (?,?)";
$stmt = $dbc->prepare($qry);
$stmt->bind_param('ss',$_SESSION['cuid'],$r['experience']);
$stmt->execute();

exit_yes('Experience added successfully!');