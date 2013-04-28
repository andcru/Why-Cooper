<?php
$proj = $dbc->query("SELECT * FROM projects JOIN files ON projects.photo = files.id WHERE projects.id='{$pg_id}'")->fetch_assoc();
$stud = new student($proj['cuid']);
?>

<h2><?php echo $proj['title']; ?></h2>

<p><b>Student: <?php echo $stud->name(); ?></b></p>

<p>Image: <img src="/users/<?php echo $proj['cuid']; ?>/uploads/<?php echo $proj['name']; ?>"></p>

<p>Project Description:</p>

<p><?php echo $proj['content']; ?></p>