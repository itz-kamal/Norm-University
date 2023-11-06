<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student
	$currentStaID = $_SESSION['staffID'];
	$currentStuPas = $_SESSION['password'];
	if ($currentStaID != "" && $currentStuPas != "") {
		$selectStuData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentStuPas' LIMIT 1";
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
		
		if (isset($_POST['submit']) && !empty($_POST['stateOfOrigin']) && !empty($_POST['localGovt']) && !empty($_POST['placeOfBirth']) && !empty($_FILES['originCertified']['name']) && !empty($_FILES['originCertified']['tmp_name']) && !empty($_FILES['originCertified']['size']) && !empty($_POST['fathersName']) && !empty($_POST['mothersName']) && !empty($_POST['nextOfKin']) && !empty($_POST['nextOfKinAddress']) && !empty($_POST['siblingMobile'])) {
			$stateOfOrigin = htmlentities($_POST['stateOfOrigin']);
			$localGovt = htmlentities($_POST['localGovt']);
			$placeOfBirth = htmlentities($_POST['placeOfBirth']);
			//prove of origin file
			$OCName = htmlentities($_FILES['originCertified']['name']);
			$OCTmpName = htmlentities($_FILES['originCertified']['tmp_name']);
			$OCSize = htmlentities($_FILES['originCertified']['size']);
			$OCError = htmlentities($_POST['originCertified']['error']);
			$kabom = explode(".", $OCName);
			$OCExt = end($kabom);
			$fathersName = htmlentities($_POST['fathersName']);
			$mothersName = htmlentities($_POST['mothersName']);
			$fatherMobile = htmlentities($_POST['fatherMobile']);
			$motherMobile = htmlentities($_POST['motherMobile']);
			$siblingMobile = htmlentities($_POST['siblingMobile']);
			$nextOfKin = htmlentities($_POST['nextOfKin']);
			$addressKin = htmlentities($_POST['nextOfKinAddress']);
			$OCExtCon = $OCExt == "png" || $OCExt == "jpeg" || $OCExt == "jpg";

			if ($OCError == 0 && $OCExtCon) {
				move_uploaded_file($OCTmpName, "proveOfOrigin/OCName");
				$insert = mysqli_query($db_conx, "INSERT INTO other_reg(id, matricNo, stateOfOrigin, localGov, placeOfBirth, proveOfOrigin, father, mother, dadMobile, momMobile, sponsor, sponsorMobile, nextOfKin, addressKin, date_made) VALUES(NULL, '$currentStaID', '$stateOfOrigin', '$localGovt', '$placeOfBirth', '$OCName', '$fathersName', '$mothersName', '$fatherMobile', '$motherMobile', '', '$siblingMobile', '$nextOfKin', '$addressKin', NOW())");
				if ($insert) {
					$report .="<div style='color:green;'>successful</div>";
				} else {
					$report .= "<div style='color:red;'>update not successful</div>";
				}
			} else {
				$report .= "<div style='color:red;'>file error</div>";
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
	<title>complete registration</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentSU.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobileRegist.css">
	<style type="text/css">
		.requiredData {
			color: gray;
		}
	</style>
</head>
<body style="background-color: #eeeeee;">
	<?php include_once("../include/staffPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Profile >> complete registration</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
			<div style="margin: 10px 20px;"><?php echo $report; ?></div>
			<div id="SSUinput">
				<div class="TOApp">Origin Information<i class="fas fa-info-circle circleFont"></i></div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">State Of Origin <span class="requiredData">**</span></span>
						<input type="text" name="stateOfOrigin" class="TQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Local Goverment <span class="requiredData">**</span></span>
						<input type="text" name="localGovt" class="TQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Place of Birth</span>
						<input type="text" name="placeOfBirth" class="TQInput">
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Prove of Origin </span>
						<input type="file" name="originCertified" class="FQInput" >
					</div>
					<div class="clearing"></div>
				</div>
			</div>
			<div id="SSUinput">
			<div class="TOApp">Parent & Guardian Information<i class="fas fa-info-circle circleFont"></i></div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Father's Name <span class="requiredData">**</span></span>
						<input type="text" name="fathersName" class="TQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Mother's Name <span class="requiredData">**</span></span>
						<input type="text" name="mothersName" class="TQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Father's Mobile </span>
						<input type="text" name="fatherMobile" class="NQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Mother's Mobile</span>
					<input type="text" name="motherMobile" class="NQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Next of Kin <span class="requiredData">**</span></span>
						<input type="text" name="nextOfKin" class="TQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Address of Next of Kin</span>
						<input type="text" name="nextOfKinAddress" class="TQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Next of Kin's Mobile <span class="requiredData">**</span></span>
						<input type="text" name="nextOfKinMobile" class="NQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Sibling Mobile <span class="requiredData">**</span></span>
						<input type="text" name="siblingMobile" class="NQInput" >
					</div>
					<div class="clearing"></div>
				</div>
			</div>
			<div><input type="submit" name="submit" class="subBtn"></div>
		</form>
	</div>
	<div class="clearing"></div>
</body>
</html>