<?php
if(isset($_SESSION['msg'])) {
	foreach($_SESSION['msg'] as $key => $type) {
		echo sprintf("<ul class='%s'>",$key);
		foreach($type as $error)
			echo sprintf("<li>%s</li>",$error);
		echo "</ul>";
	}
	unset($_SESSION['msg']);
}