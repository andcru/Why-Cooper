<a href="newproject">Post New Project</a>

<?php
$res = $dbc->query("SELECT id,title FROM projects WHERE cuid='{$me->cuid}'");
if($res->num_rows) {
	echo "<p><b>My submitted projects</b><br/>";
	while($r = $res->fetch_assoc())
		echo sprintf("<a href='/project/%d'>%s</a><br/>",$r['id'],$r['title']);
}
?>

<p><a href="/logoutx">Log Out</a></p>