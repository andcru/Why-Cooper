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

if(!$r['pg_id'] || $_FILES['file']['size']) {
	$cont = 1;
	require_once($_SERVER['DOCUMENT_ROOT'].'/exec/admin/uploadx.php');
	$main_photo = $stmt->insert_id;
	if(!$dbc->query("SELECT id FROM files WHERE id='{$main_photo}' AND image=1")->num_rows)
		exit_no('Your default image must be an image file.');
}
else {
	$res = $dbc->query("SELECT photo FROM projects JOIN files ON projects.photo = files.id WHERE projects.id='{$r['pg_id']}' AND projects.cuid='{$_SESSION['cuid']}'")->fetch_assoc();
	$main_photo = $res['photo'];
	if(!$main_photo)
		exit_no('This page does not appear to be yours to edit.');
}

if(!$r['pg_id']) {
	$qry = "INSERT INTO projects (title,content,photo,cuid,members) VALUES (?,?,?,?,?)";
	$stmt = $dbc->prepare($qry);
	$stmt->bind_param('ssdss',$r['title'],$r['page'],$main_photo,$_SESSION['cuid'],$r['members']);
}
else {
	$qry = "UPDATE projects SET title=?, content=?, photo=?, members=? WHERE id=?";
	$stmt = $dbc->prepare($qry);
	$stmt->bind_param('ssdsd',$r['title'],$r['page'],$main_photo,$r['members'],$r['pg_id']);
}
if(!$stmt->execute())
	exit_no('Execution failed: ('.$stmt->errno.') '.$stmt->error);

$id = $r['pg_id'] ? $r['pg_id'] : $stmt->insert_id;
exit_yes('Page submitted successfully!',"/admin/newproject/".$id);