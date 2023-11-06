<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentStuaPas = $_SESSION['password'];
	if ($currentStaID != "" && $currentStuaPas != "") {
		$selectStaData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentStuaPas' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectStaData);
		$checkSta = mysqli_num_rows($selectQuery);
		if ($checkSta > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = $row['department'];
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
	<title>Norm Assignments</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Assignments</div>
			<div class="floatR">Department : <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div>
				<div class="CSASPFocus">Set Assignments</div>
				<div class="CSASPFDiv">
					<a href="setAssignment.php" class="ISPFunc floatL">
						<div class="WSPSCFont">font</div>
						<div class="WSPSClick">More Info</div>
					</a>
					<div class="clearing"></div>
				</div>
				<div class="CSASPFocus">Submitted Assignments</div>
				<div class="CSASPFDiv">
					<a href="check_assignment.php" class="ISPFunc floatL">
						<div class="WSPSCFont">font</div>
						<div class="WSPSClick">More Info</div>
					</a>
					<div class="clearing"></div>
				</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>