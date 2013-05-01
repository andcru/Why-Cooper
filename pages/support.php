<h1>Support Us</h1>

<p>We are a union of Engineers, Artists and Architects who are truly dedicated to our education and our work. We have all been blessed with full-tuition scholarships, which enable us to be free from debt, free to take risks, and free to dream.</p>

<p>If you like what you have seen on this site, please help our mission by sharing our story!</p>



<h4>OurTeam</h4>

<p>This website was created in under a week as a collaborative effort by students from the Engineering and Art School.</p>

<?php
$cont = array('crudge','o2','palafo','sanabr','zukofs');

foreach($cont as $cuid) {
	$stud = new student($cuid);
	echo sprintf("<b>%s</b> - %s, Class %d<br/>",$stud->name(), $stud->maj(1), $stud->year);
}
?>

<p>If you have any questions or comments, feel free to contact us at <a href="mailto:webmaster@whycooper.org">webmaster@whycooper.org</a>.</p>