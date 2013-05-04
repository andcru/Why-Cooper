<?php
if(isset($_SESSION['msg'])) {
	foreach($_SESSION['msg'] as $key => $type) {
		echo sprintf("<div class='%s'>%s: ",$key,$key);
		echo implode("<br/>",$type);
		echo "</div>";
	}
	unset($_SESSION['msg']);
}