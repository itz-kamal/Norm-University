<?php
session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPas = $_SESSION['password'];
	if ($currentStaID != "" && $currentPas != "") {
		$selectStuData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentPas' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectStuData);
		$checkStu = mysqli_num_rows($selectQuery);
		if ($checkStu > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = $row['department'];
				$PPName = $row['passport'];
			}
		}
		//update student password
		if (isset($_POST['submit']) && !empty($_POST['oldPW']) && !empty($_POST['newPW'])) {
			$newPW = htmlentities(sha1($_POST['newPW']));
			$oldPW = htmlentities(sha1($_POST['oldPW']));
			$report = "";
			$updatePW = "UPDATE studentsIn_normUni SET password = '$newPW' , oldPassword = '$newPW' WHERE matricNo = '$currentStuMatNo' AND firstName = '$firstName' ";
			$updQuery = mysqli_query($db_conx, $updatePW);
			if ($updQuery) {
				$report .="<div style='color:green;'>passord changed successfully</div>";
			} else {
				$report .="<div style='color:red;'>passord unsuccessful</div>";
			}
		}
	} else {
		header("location:signIn.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>student dashboard</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Change Password</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="CHDSec">
					<span class="CHPText">Old Password : </span>
					<input type="password" name="oldPW" class="CHPInp">
				</div>
				<div class="CHDSec">
					<span class="CHPText">New Password : </span>
					<input type="password" name="newPW" class="CHPInp">
				</div>
				<div class="CHDSec">
					<span class="CHPText">Confirm Password : </span>
					<input type="password" name="" class="CHPInp">
				</div>
				<div><?php echo $report; ?></div>
				<div style="margin-top: 15px;">
					<input type="submit" name="submit" class="CHPSBtn">
				</div>
			</form>
		</div>
	</div>
</body>
</html>