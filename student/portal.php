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
	<?php include_once("../include/stuPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Profile</div>
				<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div>
					<div class="CSASPFocus">Biodata</div>
					<div class="CSASPFDiv">
						<?php 
						$slecReg = mysqli_query($db_conx, "SELECT * FROM other_reg WHERE matricNo = '$currentStuMatNo' LIMIT 1");
						$checkreg = mysqli_num_rows($slecReg);
						if ($checkreg > 0) {
							//display nothing
						} else {
							echo "<a href='registration.php' class='ISPFunc floatL'>
							<div class='WSPSCFont'><i class='fas fa-user'></i></div>
							<div class='WSPSClick'>Complete registration</div>
							</a>";
						}
						?>
						<a href="updateBio.php" class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="fas fa-user"></i></div>
							<div class="WSPSClick">Update Biodata</div>
						</a>
						<a href="view_biodata.php" class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="fas fa-user"></i></div>
							<div class="WSPSClick">View Biodata</div>
						</a>
						<div class="clearing"></div>
					</div>
				</div>
				<div>
					<div class="CSASPFocus">Results</div>
					<div class="CSASPFDiv">
						<a href="session_result.php" class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="far fa-file-image"></i></div>
							<div class="WSPSClick">View Result</div>
						</a>
						<a href="#" class="ISPFunc floatL">
							<div class="WSPSCFont"><i class="far fa-file-image"></i></div>
							<div class="WSPSClick">View Academic Profile</div>
						</a>
						
						<div class="clearing"></div>
					</div>
				</div>
				<div>
					<div class="CSASPFocus">Medicals</div>
					<div class="CSASPFDiv">
						<?php
						//check if medical foem is already submiited to display or not
						$selMedic = mysqli_query($db_conx, "SELECT health FROM medical_form WHERE matricNo = '$currentStuMatNo'");
						$chekMedic = mysqli_num_rows($selMedic);
						if ($chekMedic > 0) {
							echo "<a href='medical_form_data.php' class='ISPFunc floatL'>
									<div class='WSPSCFont'><i class='fas fa-notes-medical'></i></div>
									<div class='WSPSClick'>Medical data</div>
								</a>";
						} else {
							echo "<a href='medical_form.php' class='ISPFunc floatL'>
									<div class='WSPSCFont'><i class='fas fa-notes-medical'></i></div>
									<div class='WSPSClick'>View Medical Form</div>
								</a>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="clearing"></div>
</body>
</html>