<?php
	session_start();
	$_SESSION['matricNo'] = "";
	$_SESSION['password'] = "";
	session_destroy();
	header("location:login.php");
	exit();
?>