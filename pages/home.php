<p><b>Site under construction. Current students, login <a href="/login">here</a>.</b></p>
<div class="home-col1">
	<div class="home-box">
		<h1>Check out the story of Cooper Union - told by its students</h1>
		<ul id="imgslider">
			<li data-title="Image1"><img src="http://placehold.it/600x380/000000"></li>
			<li data-title="Image2"><img src="http://placehold.it/600x380/222222"></li>
			<li data-title="Image3"><img src="http://placehold.it/600x380/444444"></li>
			<li data-title="Image4"><img src="http://placehold.it/600x380/666666"></li>
			<li data-title="Image5"><img src="http://placehold.it/600x380/888888"></li>
		</ul>
	</div>	
	<div class="home-box">
		<h1>WhyCooper.org <span class="hl-gray">| Our Mission</span></h1>
		<p>What would you do if there was a place where your economic situation didn't limit your opportunities?  What would happen if hundreds of people were put in an environment like this and their success was only determined by their own effort?  There is one last place that offers this, but you might not yet know it.  The Cooper Union for the Advancement of Science and Art is one of the last free colleges in the US.  WhyCooper.org was made to show the world what can come from such an environment and why we are so proud to be students at this institution.
</p>
	</div>
</div><div class="home-col2"> <!--Important: do not put on new line, there must be no space between these 2 div's -->
	<div class="home-box">
		<?php
		$proj = $dbc->query("SELECT projects.id,title,projects.cuid,name AS photo,members FROM projects JOIN files ON projects.photo = files.id ORDER BY ranking DESC, id DESC LIMIT 1")->fetch_assoc();
		$stud = new student($proj['cuid']);
		$proj['student'] = $stud->name().' ('.$stud->maj(0,0,1).' '.$stud->year.')';
		?>
		<h2 class="hl-gray">FEATURED STUDENT PROJECT</h2>
		<div class="img-showcase-crop" style="background-image:url('http://whycooper.org/users/<?php echo $proj['cuid']; ?>/uploads/t/<?php echo $proj['photo']; ?>');"></div>
		<h3 class="hl-red feature"><?php echo $proj['title']; ?></h3>
		<p><?php echo $proj['student']; ?></p>
		<a class="readmore" href="/project/<?php echo $proj['id']; ?>">view project</a>
	</div>
	<div class="home-box">
		<h2 class="hl-gray">FEATURED COOPER ALUMNI</h2>
		<div class="img-feat-crop"><img src="http://placehold.it/270x140"></div>
		<h3 class="hl-red feature">Alumni Name</h3>
		<p>Job Title</p>
		<a class="readmore" href="#">view alumnus</a>
	</div>
	<div class="home-box">
		<h2 class="hl-gray">FEATURED COOPER EXPERIENCE</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit mollis varius. Etiam ornare placerat massa.</p> 
		<h3 class="hl-red text-right">- Writer Name</h3>
		<a class="readmore" href="#">view more</a>
	</h2>
</div>