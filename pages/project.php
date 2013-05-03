<?php
$proj = $dbc->query("SELECT * FROM projects JOIN files ON projects.photo = files.id WHERE projects.id='{$pg_id}'")->fetch_assoc();
$stud = new student($proj['cuid']);
?>

<link rel="stylesheet" type="text/css" href="../css/project.css"/>

<h2 class="singleProjectTitle"><?php echo $proj['title']; ?></h2>
<h3 class="projectSchool">Engineering</h3>

<p>Project by: <a href=""><?php echo $stud->name(); ?></a></h2>

<div class="projectMainContent">
	<p><img class="projectImage" src="http://whycooper.org/users/<?php echo $proj['cuid']; ?>/uploads/<?php echo $proj['name']; ?>" width="500px"></p>
	
	<div class="projectDescription">
		<p>Project Description:</p>
		<p><?php echo $proj['content']; ?></p>
	</div>

</div>

<!--
<div class="suggestedProjectContent">
	<div class="similarProjectTitle">CHECK OUT SOME SIMILAR PROJECTS</div>
	<div class="suggestedProject"><div class="imageContainer"><img class="suggestedProjectImage crop" src="http://whycooper.org/users/<?php echo $proj['cuid']; ?>/uploads/<?php echo $proj['name']; ?>"/></div><h2>Project 1</h2><p class="suggestedProjectDescription">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p></div>
	<div class="suggestedProject"><div class="imageContainer"><img class="suggestedProjectImage crop" src="http://whycooper.org/users/<?php echo $proj['cuid']; ?>/uploads/<?php echo $proj['name']; ?>"/></div><h2>Project 2</h2><p class="suggestedProjectDescription">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p></div>
	<div class="suggestedProject"><div class="imageContainer"><img class="suggestedProjectImage crop" src="http://whycooper.org/users/<?php echo $proj['cuid']; ?>/uploads/<?php echo $proj['name']; ?>"/></div><h2>Project 3</h2><p class="suggestedProjectDescription">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p></div>
</div>
-->
