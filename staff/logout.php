<?php
	session_start();
	$_SESSION['staffID'] = "";
	$_SESSION['password'] = "";
	session_destroy();
	header("location:signIn.php");
	exit();
?>