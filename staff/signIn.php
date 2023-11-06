<?php
session_start();
include_once("../include/connect.php");

if (isset($_POST['submit']) && !empty($_POST['staffID']) && !empty($_POST['password'])) {
	$staffID = htmlentities($_POST['staffID']);
	$password = htmlentities(sha1($_POST['password']));
	//select user data
	$selectQuery = mysqli_query($db_conx, "SELECT staffID,password FROM staffsInto_normUni WHERE staffID = '$staffID' AND password = '$password' LIMIT 1");
	$checkDB = mysqli_num_rows($selectQuery);
	if ($checkDB > 0) {
		while ($row = mysqli_fetch_array($selectQuery)) {
			$_SESSION['staffID'] = $staffID;
			$_SESSION['password'] = $password;
			if ($_SESSION['staffID'] != "" && $_SESSION['password'] != "") {
				header("location:portal.php");
				exit();
			}
		}
	} else {
		$report .="<div style='color:red;'>invalid login</div>";
	}
} else {}
?>
<!DOCTYPE html>
<html>
<head>
	<title>norm Staff Login Portal</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentSI.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobileSignIn.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
</head>
<body>
	<div class="OACov">
		<div class="text01">Norm Staff</div>
		<div class="text01">Login to your Account</div>
		<div><i class="fas fa-lock lockedFont"></i></div>
		<div style="margin: 10px 0; text-align: center;"><?php echo $report; ?></div>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<div class="text02">Saff ID</div>
			<input type="text" name="staffID" id="NumInt" class="PWInt" placeholder="matric no">
			<div class="text02">Password</div>
			<input type="Password" name="password" class="PWInt" placeholder="password">
			<div  class="LISec"></div>
			<a class="text03">Forgot Password?</a>
			<div style="clear: both;"></div>
			<input type="submit" name="submit" value="Login" class="LISub">
			<div class="text04">New Staff? <a href="signUp.php" class="AppSec">Apply into Norm</a></div>
		</form>
	</div>
	<script type="text/javascript" src="js/studentSI.js"></script>
</body>
</html>
