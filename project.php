<?php
$proj = $dbc->query("SELECT * FROM projects JOIN files ON projects.photo = files.id WHERE projects.id='{$pg_id}'")->fetch_assoc();
?>

<h2><?php echo $proj['title']; ?></h2>

<p><img src="/users/<?php echo $proj['cuid']; ?>/uploads/<?php echo $proj['name']; ?>"></p>