<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/imagex.php');

$r = $_POST;
$members = array();

$mem = implode(",",$members);

notblank($r);

$r['page'] = imageShrink($r['page']);

$cont = 1;
include_once($_SERVER['DOCUMENT_ROOT'].'/admin/uploadx.php');
$main_photo = $stmt->insert_id;

$qry = "INSERT INTO projects (title,content,photo,cuid,members) VALUES (?,?,?,?,?)";
$stmt = $dbc->prepare($qry);
$stmt->bind_param('ssdss',$r['title'],$r['page'],$main_photo,$_SESSION['cuid'],$mem);
$stmt->execute();

exit_yes('Page submitted successfully!',"/admin/home");