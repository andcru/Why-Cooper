<?php

unset($_SESSION['cuid']);
session_destroy();
header('location: /');

?>