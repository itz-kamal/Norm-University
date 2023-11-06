<?php
	session_start();
	$_SESSION['matricNo'] = "";
	$_SESSION['password'] = "";
	session_destroy();
	header("location:signIn.php");
	exit();
?>