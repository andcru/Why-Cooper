<div class="home-col1">
	<div class="home-box">
		<h1>Check out the story of Cooper Union - as told by its students</h1>
		<ul id="imgslider">
			<li data-title="Image2"><div class="panel-panel"><img src="/img/slider/2.png"><!--<span class="caption"></span>--></div></li>
			<li data-title="Image3"><div class="panel-panel"><img src="/img/slider/3.png"><!--<span class="caption"></span>--></div></li>
			<li data-title="Image4"><div class="panel-panel"><img src="/img/slider/4.png"><!--<span class="caption"></span>--></div></li>
			<li data-title="Image1"><div class="panel-panel"><img src="/img/slider/1.png"><!--<span class="caption"></span>--></div></li>
			<li data-title="Image5"><div class="panel-panel"><img src="/img/slider/5.png"><!--<span class="caption"></span>--></div></li>

		</ul>
	</div>	
	<div class="home-box">
		<h1>WhyCooper.org <span class="hl-gray">| Our Mission</span></h1>
		<p>What would you do if there were a place where your economic situation didn't limit your opportunities?  What would happen if hundreds of people were put in an environment like this and their success was only determined by their own effort?  There is one last place that offers this, but you might not yet know it.  The Cooper Union for the Advancement of Science and Art is one of the last free colleges in the US.  WhyCooper.org was made to show the world what can come from such an environment and why we are so proud to be students at this institution.
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
		<?php
			$alum = $dbc->query("SELECT * FROM alumni ORDER BY ranking DESC LIMIT 1")->fetch_assoc();
		?>
		<h2 class="hl-gray">FEATURED COOPER ALUMNUS</h2>
		<h3 class="hl-red feature"><?php echo $alum['name']; ?></h3>
		<p><?php echo $alum['description']; ?></p>
		<a class="readmore" href="<?php echo $alum['link']; ?>">view alumnus</a>
	</div>
	<div class="home-box">
		<?php
			$exp = $dbc->query("SELECT * FROM experiences ORDER BY ranking DESC, id DESC LIMIT 1")->fetch_assoc();
			$stud = new student($exp['cuid']);
			$class = $stud->maj(1)." '".substr($stud->year,2).')';
		?>
		<h2 class="hl-gray">FEATURED COOPER EXPERIENCE</h2>
		<p>"<?php echo $exp['experience']; ?>"</p> 
		<h3 class="hl-red text-right">&#8212; <?php echo $stud->name(); ?></h3>
		<a class="readmore" href="/experiences">view more</a>
	</div>
</div>
