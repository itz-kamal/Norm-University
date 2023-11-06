<?php
session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPas = $_SESSION['password'];
	if ($currentStaID != "" && $currentPas != "") {
		$selectStaData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentPas' LIMIT 1";
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
	<title>staff dashboard</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Profile</div>
				<div class="floatR">Department : <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div>
					<div class="CSASPFocus">Biodata</div>
					<div class="CSASPFDiv">
						<?php
						//check if data is filled
						$selectReg = mysqli_query($db_conx, "SELECT * FROM other_reg WHERE matricNo='$currentStaID' ");
						$checkReg = mysqli_num_rows($selectReg);
						if ($checkReg > 0) {
							//display nothing
						} else {
							echo "<a href='registration.php' class='ISPFunc floatL'>
							<div class='WSPSCFont'><i class='fas fa-user'></i></div>
							<div class='WSPSClick'>Complete registration</div>
							</a>";
						}
						?>
						
						<a href="viewBiodata.php" class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="fas fa-user"></i></div>
							<div class="WSPSClick">Update Biodata</div>
						</a>
						<div class="clearing"></div>
					</div>
				</div>
				<div>
					<div class="CSASPFocus">Results</div>
					<div class="CSASPFDiv">
						<a href="postresult.php" class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="far fa-file-image"></i></div>
							<div class="WSPSClick">Post Result</div>
						</a>
						<a class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="far fa-file-image"></i></div>
							<div class="WSPSClick">View student Academic Profile</div>
						</a>
						
						<div class="clearing"></div>
					</div>
				</div>
				<div>
					<div class="CSASPFocus">Manage My Students</div>
					<div class="CSASPFDiv">
						<a href="my_students.php" class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="far fa-file-image"></i></div>
							<div class="WSPSClick">My Students</div>
						</a>
						<a href="student_result.php" class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="far fa-file-image"></i></div>
							<div class="WSPSClick">Post Student Results</div>
						</a>
						<div class="clearing"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearing"></div>
</body>
</html>