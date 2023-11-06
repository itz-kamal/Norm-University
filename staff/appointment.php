<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPass = $_SESSION['password'];

	if ($currentStaID != "" && $currentPass != "") {
		$selectStuData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentPass' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectStuData);
		$checkStu = mysqli_num_rows($selectQuery);
		if ($checkStu > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = strtoupper($row['department']);
				$PPName = $row['passport'];
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
	<title>appointment</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Appointments</div>
				<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div>
					<div class="CSASPFocus">fix Appointment</div>
					<div class="CSASPFDiv">
						<a href="medical_appointment.php" class="ISPFunc floatL">
							<div class="WSPSCFont">font</div>
							<div class="WSPSClick">Medical Appointment</div>
						</a>
						<a href="lecture_appointment.php" class="ISPFunc floatL">
							<div class="WSPSCFont">font</div>
							<div class="WSPSClick">Appointment with Lecturer</div>
						</a>
						<div class="clearing"></div>
					</div>
				</div>
				<div>
					<div class="CSASPFocus">All Appointmnets</div>
					<div class="CSASPFDiv">
						<a href="all_medical_appoint.php" class="ISPFunc floatL">
							<div class="WSPSCFont">font</div>
							<div class="WSPSClick">Medical Appointment</div>
						</a>
						<a href="past_student_appoint.php" class="ISPFunc floatL">
							<div class="WSPSCFont">font</div>
							<div class="WSPSClick">Appointment with Students</div>
						</a>
						<div class="clearing"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearing"></div>
	</div>
</body>
</html>