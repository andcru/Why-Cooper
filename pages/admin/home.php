<div class="pull-left">
<p><a href="newproject">Post New Project</a></p>

<p><a href="newexperience">Post New Experience / Testimonial</a></p>

<p><a href="/logoutx">Log Out</a></p>
</div>
<div class="pull-right">
	<h2>My submitted projects:</h2>
	<hr/>
	<?php
	$res = $dbc->query("SELECT id,title FROM projects WHERE cuid='{$me->cuid}'");
	if($res->num_rows)
		while($r = $res->fetch_assoc()) {
			echo sprintf('<div>%s</div><div><a href="/project/%d">View</a> | <a href="/admin/newproject/%d">Edit</a></div><hr/>',$r['title'],$r['id'],$r['id']);
		}

	?>
</div>