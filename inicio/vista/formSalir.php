<?php
session_start();

foreach($_SESSION as $k => $v)
	unset($_SESSION[$k]);
	
session_destroy();
header("Location:../index.php");
?>
