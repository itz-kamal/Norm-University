<?php
	session_start();
	include_once("../include/connect.php");

	if (isset($_POST['submit']) && !empty($_POST['matricNo']) && !empty($_POST['password'])) {
		
		$matricNo = htmlentities($_POST['matricNo']);
		$password = htmlentities(sha1($_POST['password']));
		$selectSTU = "SELECT matricNo,password FROM studentsIn_normUni WHERE matricNo = '$matricNo' AND password = '$password' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectSTU);
		$checkSTU = mysqli_num_rows($selectQuery);
		if ($checkSTU > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$_SESSION['matricNo'] = $matricNo;
				$_SESSION['password'] = $password;
				if ($_SESSION['matricNo'] != "" && $_SESSION['password'] != "") {
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
	<title>norm Student Login Portal</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentSI.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobileSignIn.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
</head>
<body>
	<div class="OACov">
		<div class="text01">Login to your Account</div>
		<div><i class="fas fa-lock lockedFont"></i></div>
		<div style="margin-top: 10px; margin-bottom: 10px;"><?php echo $report; ?></div>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<div class="text02">Matric No / Application No</div>
			<input type="text" name="matricNo" id="NumInt" class="PWInt" placeholder="matric no">					
			<div class="text02">Password</div>
			<input type="Password" name="password" class="PWInt" placeholder="password">
			<div  class="LISec"></div>
			<a class="text03">Forgot Password?</a>
			<div style="clear: both;"></div>
			<input type="submit" name="submit" value="Login" class="LISub">
			<div class="text04">New Student? <a href="signUp.php" class="AppSec">Apply into Norm</a></div>
		</form>
	</div>
	<script type="text/javascript" src="js/studentSI.js"></script>
</body>
</html>
