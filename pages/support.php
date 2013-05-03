
		<h1>Support the Cooper Union</h1>
		<p>Share Cooper's story or donate to support scholarships for its students.  Any message, big or small, helps!</p>
		<div class="support">
			<div class="support-box">
				<h2>Sign Up for Our Newsletter</h2>
				<p>Send us your email to be notified when our donation page goes live and to receive occassional emails about updates to WhyCooper.org</p>
				<form method="POST" action="/emailx">
				<center>Email: <input type="text" name="email"> <input type="Submit"></center>
			</div>
			<div class="support-box">
				<h2>Donate to Student Scholarships (Coming Soon)</h2>
				<p>We're working on a solution that will allow us to take donations to go specifically to a fund designated for student scholarships.  In the meantime, sign up for our newsletter and find out when this feature will be available!</p>
			</div>
			<div class="support-box">
				<h2>Share Our Story</h2>
				<p>Spread the word about WhyCooper.org and the Cooper Union community</p>
			</div>
			<div class="support-box" style="margin-top:50px">
				<h2>Our Team</h2>
				<p>This website was created in four days as a collaborative effort by students from the Engineering and Art School.</p>
				<p>
				<?php
				$cont = array('crudge','o2','palafo','sanabr','zukofs');

				foreach($cont as $k => $cuid) {
					$stud = new student($cuid);
					echo sprintf("<b>%s</b> - %s, Class %d<br/>",$stud->name(), $stud->maj(1), $stud->year, $resp[$k]);
				}
				?>
				</p>
				<p>If you have any questions or comments, feel free to contact us at: <a href="mailto:webmaster@whycooper.org">webmaster@whycooper.org</a>.</p>
		</div>
	






