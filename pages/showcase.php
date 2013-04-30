<link rel="stylesheet" type="text/css" href="/css/showcase.css">

<div class="pull-right" id="school_selects">
	<ul class="navlist">
		<li class="ul-head" > SORT PROJECTS</li>
		<li class="hl-blue" ><label for="sel_art">ART 			</label><input id="sel_art" type="checkbox" class="sel_school push-right" value="Art" checked></li>
		<li class="hl-red"  ><label for="sel_arc">ARCHITECTURE 	</label><input id="sel_arc" type="checkbox" class="sel_school push-right" value="Architecture" checked></li>
		<li class="hl-green"><label for="sel_eng">ENGINEERING 	</label><input id="sel_eng" type="checkbox" class="sel_school push-right" value="Engineering" checked></li>
	</ul>
</div>

<h1>Project Showcase</h1>
<p>Curious to see how Cooper Union students use their free education?</p>
<p>Browse projects made by students and alumni from all three schools.</p>

<div id="all_projects" style="width:940px">
	<?php
	$arr = array("Architecture","Art","Engineering");
	for($i=0;$i<15;$i++) {
		$rand = rand(0,2);
		//echo '<div class="student_project '.$arr[$rand].'"><h3>'.$arr[$rand].'</h3></div>';
	}
	?>

</div>