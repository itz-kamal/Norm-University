
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
	<title>student dashboard</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
</head>
<body>
	<?php include_once("../include/stuPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Assignments</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div>
				<div class="CSASPFocus">Assignments</div>
				<div class="CSASPFDiv">
					<a href="send_assignment.php" class="ISPFunc floatL">
						<div class="WSPSCFont">font</div>
						<div class="WSPSClick">More Info</div>
					</a>
					<div class="clearing"></div>
				</div>
				<div class="CSASPFocus">Past Assignments</div>
				<div class="CSASPFDiv">
					<a href="pastAssignment.php" class="ISPFunc floatL">
						<div class="WSPSCFont">font</div>
						<div class="WSPSClick">records</div>
					</a>
					<div class="clearing"></div>
				</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>