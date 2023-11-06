<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student
	$currentStuMatNo = $_SESSION['matricNo'];
	$currentStuPas = $_SESSION['password'];
	if ($currentStuMatNo != "" && $currentStuPas != "") {
		$selectQuery = mysqli_query($db_conx, "SELECT * FROM studentsIn_normUni WHERE matricNo = '$currentStuMatNo' AND password = '$currentStuPas' LIMIT 1");
		$checkStu = mysqli_num_rows($selectQuery);
		if ($checkStu > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = $row['department'];
				$PPName = $row['passport'];
			}
		}
		//get users inputs
		$selMedicDatas = mysqli_query($db_conx, "SELECT * FROM medical_form WHERE matricNo='$currentStuMatNo' ");
		$checkMedic = mysqli_num_rows($selMedicDatas);
		if ($checkMedic > 0) {
			while ($row = mysqli_fetch_array($selMedicDatas)) {
				$health = $row['health'];
				$disability = $row['disability'];
				$medication = $row['requireMedic'];
				$hospilatized = $row['hospitalized'];
				$illness1 = $row['illness1'];
				$illness2 = $row['illness2'];
				$condition1 = $row['medicalCondition1'];
				$condition2 = $row['medicalCondition2'];
				$smoke = $row['smoke'];
				$alcohol = $row['alcoholic'];
				$hypertension = $row['hypertension'];
				$epilepsy = $row['epilepsy'];
				$mental = $row['mentalIllness'];
				$cancer = $row['breastCancer'];
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
	<link rel="stylesheet" type="text/css" href="../css/studentSU.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		.dataAns {
		    color: gray;
		    font-weight: 300;
		    border-bottom: 1px solid #525252e8;
		    padding-bottom: 2px;
		}
	</style>
</head>
<body style="background-color: #eeeeee;">
	<?php include_once("../include/stuPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Profile >> medical data</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
			<div style="margin: 10px 20px;"><?php echo $report; ?></div>
			<div id="SSUinput">
			<div class="TOApp">Medical Information<i class="fas fa-info-circle circleFont"></i></div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Health Status </span>
						<span class="dataAns"><?php echo $health; ?></span>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Specific Disability </span>
						<span class="dataAns"><?php echo $disability; ?></span>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Medication Required <span class="requiredData">**</span></span>
						<span class="dataAns"><?php echo $medication; ?></span>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Have you ever been Hospitalized </span>
						<span class="dataAns"><?php echo $hospilatized; ?></span>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Illness for Hospitalization 1</span>
						<span class="dataAns"><?php echo $illness1; ?></span>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Illness for Hospitalization 2</span>
						<span class="dataAns"><?php echo $illness2; ?></span>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Medical Conditions you have Now / Before 1 </span>
						<span class="dataAns"><?php echo $condition1; ?></span>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Medical Conditions you have Now / Before 2</span>
						<span class="dataAns"><?php echo $condition2; ?></span>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Do you Smoke? </span>
						<span class="dataAns"><?php echo $smoke; ?></span>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Do you take Alcohol? </span>
						<span class="dataAns"><?php echo $alcohol; ?></span>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Any Family History of Hypertension</span>
						<span class="dataAns"><?php echo $hypertension; ?></span>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Any Family History of Epilepsy </span>
						<span class="dataAns"><?php echo $epilepsy; ?></span>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Any Family History of Mental illness </span>
						<span class="dataAns"><?php echo $mental; ?></span>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Any Family History of Breast Cancer</span>
						<span class="dataAns"><?php echo $cancer; ?></span>
						</div>
					<div class="clearing"></div>
				</div>
			</div>
		</form>
	</div>
	<div class="clearing"></div>
</body>
</html>