<?php
	#Destroys session data and goes to login page
	session_start();
	session_destroy();
	header("location:../../index.php");
?>
