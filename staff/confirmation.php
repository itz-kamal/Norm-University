<?php
	session_start();
	include_once("../include/connect.php");

	$staffID = $_SESSION['staffID'];
	$lastName = $_SESSION['lastName'];
	if ($staffID != "" && $lastName != "") {
		$title = $_SESSION['title'];
		$firstName = $_SESSION['firstName'];
		$department = $_SESSION['departName'];

		if (isset($_POST['submit'])) {
				$currentSMNo = "";
				$currentSLName = "";
				$currentSitle = "";
				$depart = "";
				$currentEM = "";
				$currentFN = "";
				header("location:signIn.php");
				exit();
		} else {}
	} else {
		header("location:signIn.php");
		exit();
	}
	

?>

<!DOCTYPE html>
<html>
<head>
	<title>student sign up confirmation page</title>
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentConfrim.css">
</head>
<body>
	<div class="Ssec floatL" id="MBody1">
		<div class="ICon"><img src="../images/schoolLogo.png" alt="school logo" class="imageCover"></div>
		<div class="BText01">Welcome to Norm University</div>
		<div>
			<div class="GCStu">Dear <?php echo $title." ".$lastName ; ?>,
			</div>
			<div class="WMess">Welcome to the <?php echo (date("Y") - 1)." / ".date("y"); ?></div>
			<div class="MCon">given the current circumstance, We will work together to maintain health and safety standards, while sustaining the academic excellence and personalized attention. <br>The <?php echo (date("Y") - 1)."-".date("Y"); ?> theme is "Go All the Way".</div>
		</div>
	</div>
	<div class="floatR CRSSec" id="MBody2">
		<div class="BText02">WELCOME</div>
		<div class="FDSec">
			<div>
				<span class="MFonts"><i class="fab fa-facebook-f"></i></span>
				<span class="MFonts"><i class="fab fa-linkedin-in"></i></span>
				<span class="MFonts"><i class="fab fa-twitter"></i></span>
			</div>
			<div class="FCom">follow us up on our social media pages</div>
		</div>
		<div>
			<div style="color: #313131de; font-size: 95%;">
				<span style="font-size: 105%;">Note : <!--the current student title and name inside a span--><span style="color: darkred;"><?php echo $title ." ". $lastName; ?></span></span> => Your Staff ID is <!--the current student matric number--><span style="color: darkred;"> <?php echo $staffID; ?> </span> and your default password is your last name ( <!--the current student last name--><span style="color: darkred;"><?php echo $lastName; ?></span> ). Please kindly change your password on your first login
			</div>
			
			<div style="margin-top: 15px;">You have successfully being employed into Norm University. To the program of your choice. We will be wishing you the best experience here. Enjoy your stay with other Norm lectures. Login into your staff portal below.</div>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="LIBtn">
				<div>
					<input type="submit" name="submit" value="LOGIN" class="LIAn">
				</div>
			</form>
			<div>Thank you for choosing Norm.</div><br>
			<div>We give the best experience.</div>
		</div>
	</div>
	<div class="clearing"></div>
</body>
<script type="text/javascript">
	var screenHeight = window.innerHeight+"px";
	document.querySelector('#MBody1').style.height = screenHeight;
	document.querySelector('#MBody2').style.height = screenHeight;


</script>
</html>