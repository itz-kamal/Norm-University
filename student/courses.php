<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStuMatNo = $_SESSION['matricNo'];
	$currentStuPas = $_SESSION['password'];

	if ($currentStuMatNo != "" && $currentStuPas != "") {
		$selectStuData = "SELECT * FROM studentsIn_normUni WHERE matricNo = '$currentStuMatNo' AND password = '$currentStuPas' LIMIT 1";
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
	} else {
		header("location:studentSI.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My courses</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
</head>
<body>
	<?php include_once("../include/stuPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Courses</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div>
				<div class="CSASPFocus">Registration</div>
				<div class="CSASPFDiv">
					<a href="courseReg.php" class="ISPFunc floatL">
						<div class="WSPSCFont">font</div>
						<div class="WSPSClick">Course Registration</div>
					</a>
					<a href="view_courses.php" class="ISPFunc floatL">
						<div class="WSPSCFont"><i class="far fa-file-image"></i></div>
						<div class="WSPSClick">View Registrations</div>
					</a>
					<div class="clearing"></div>
				</div>
				<div class="CSASPFocus">Course Enquiery</div>
				<div class="CSASPFDiv">
					<div class="ISPFunc floatL">
						<div class="WSPSCFont">font</div>
						<div class="WSPSClick">about Courses</div>
					</div>
					<div class="clearing"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>