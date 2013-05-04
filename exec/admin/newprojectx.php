<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/exec/admin/imagex.php');

$r = $_POST;

$except = array('cuid_0');

notblank($r,$except);

foreach($r as $k => $val)
	if(substr($k,0,4) == 'cuid' && $val) {
		$stud = new student($val);
		if(!$stud->valid)
			exit_no('CUID "'+$val+'" does not belong to a valid student.');
		$cuids[] = $val;
	}

$r['members'] = implode(",",$cuids);

$r['page'] = imageShrink($r['page']);

$cont = 1;
require_once($_SERVER['DOCUMENT_ROOT'].'/exec/admin/uploadx.php');
$main_photo = $stmt->insert_id;
if(!$dbc->query("SELECT id FROM files WHERE id='{$main_photo}' AND image=1")->num_rows)
	exit_no('Your default image must be an image file.');

$qry = "INSERT INTO projects (title,content,photo,cuid,members) VALUES (?,?,?,?,?)";
$stmt = $dbc->prepare($qry);
$stmt->bind_param('ssdss',$r['title'],$r['page'],$main_photo,$_SESSION['cuid'],$r['members']);
if(!$stmt->execute())
	exit_no('Execution failed: ('.$stmt->errno.') '.$stmt->error);

exit_yes('Page submitted successfully!',"/admin/home");