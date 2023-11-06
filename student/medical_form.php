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
		if (isset($_POST['submit']) && !empty($_POST['healthStatus']) && !empty($_POST['medications']) && !empty($_POST['epilepsy']) && !empty($_POST['smoker']) && !empty($_POST['alcohols']) && !empty($_POST['mentalIllness'])) {
			$healthStatus = htmlentities($_POST['healthStatus']);
			$disability = htmlentities($_POST['disability']);
			$medics = htmlentities($_POST['medications']);
			$hospitalized = htmlentities($_POST['hospitalized']);
			$illness1 = htmlentities($_POST['illness1']);
			$illness2 = htmlentities($_POST['illness2']);
			$medicCondition1 = htmlentities($_POST['medicCondition1']);
			$medicCondition2 = htmlentities($_POST['medicCondition2']);
			$smoker = htmlentities($_POST['smoker']);
			$alcoholic = htmlentities($_POST['alcohols']);
			$hypertension = htmlentities($_POST['hypertension']);
			$epilepsy = htmlentities($_POST['epilepsy']);
			$mentalIllness = htmlentities($_POST['mentalIllness']);
			$breastCancer = htmlentities($_POST['breastCancer']);
			//submit details
			$insert = mysqli_query($db_conx, "INSERT INTO medical_form(id, matricNo,  health, disability, requireMedic, hospitalized, illness1, illness2, medicalCondition1, medicalCondition2, smoke, alcoholic, hypertension, epilepsy, mentalIllness, breastCancer, date_made) VALUES(NULL, '$currentStuMatNo', '$healthStatus', '$disability', '$medics', '$hospitalized', '$illness1', '$illness2', '$medicCondition1', '$medicCondition2', '$smoker', '$alcoholic', '$hypertension', '$epilepsy', '$mentalIllness', '$breastCancer', NOW())");
			if ($insert) {
				$report .="<div style='color:green;'>form submitted</div>";
			} else {
				$report .= "<div style='color:red;'>form not submitted</div>";
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
		.requiredData {
			color: gray;
		}
	</style>
</head>
<body style="background-color: #eeeeee;">
	<?php include_once("../include/stuPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Profile >> complete registration</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
			<div style="margin: 10px 20px;"><?php echo $report; ?></div>
			<div id="SSUinput">
			<div class="TOApp">Medical Information<i class="fas fa-info-circle circleFont"></i></div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Health Status <span class="requiredData">**</span></span>
						<select class="TQInput" name="healthStatus" >
							<option value="healty">Healthy</option>
							<option value="fine">Fine</option>
							<option value="bad">Bad</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Specific Disability <span class="requiredData">**</span></span>
						<select class="TQInput" name="disability" >
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Medication Required <span class="requiredData">**</span></span>
						<select class="TQInput" name="medications">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Have you ever been Hospitalized <span class="requiredData">**</span></span>
						<select class="TQInput" name="hospitalized">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Illness for Hospitalization 1</span>
						<select class="TQInput" name="illness1">
							<option value="none">None</option>
							<option value="abnormalHeartBeat">Abnormal Heart Beat</option>
							<option value="abnormalNippleDischarge">Abnormal Nipple Discharge</option>
							<option value="abnormalVaginalBleeding">Abnormal Vaginal Bleeding</option>
							<option value="allergy">Allergy</option>
							<option value="anxietyDisorder">Anxiety Disorder</option>
							<option value="arthritis">Arthritis</option>
							<option value="asthma">Asthma</option>
							<option value="covid_19">COVID-19</option>
							<option value="drugAddiction">Drug Addiction</option>
							<option value="epilepsy">Epilepsy</option>
							<option value="faintingAttacks">Fainting Attacks</option>
							<option value="fracture">FRACTURE</option>
							<option value="hepatitis">Hepatitis</option>
							<option value="highBloodCholestrol">High Blood Cholestrol</option>
							<option value="hypertension">Hypertension</option>
							<option value="malaria">Malaria</option>
							<option value="meningitis">Meningitis</option>
							<option value="depression">Mental Illness / Depression</option>
							<option value="pneumonia">Pneumonia</option>
							<option value="rapeVictim">Rape Victim</option>
							<option value="recurrentMigrane">Recurrent Migrane</option>
							<option value="sickleCell">Sickle Cell Disease</option>
							<option value="STD">STD</option>
							<option value="surgery">Surgery</option>
							<option value="tuberculosis">Tuberculosis</option>
							<option value="typoid">Typhoid</option>
							<option value="prepicUlcer">Prepic Ulcer Disease</option>
							<option value="ulterineFibriods">Ulterine Fibriods</option>
							<option value="others">Others</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Illness for Hospitalization 2</span>
						<select class="TQInput" name="illness2">
							<option value="none">None</option>
							<option value="abnormalHeartBeat">Abnormal Heart Beat</option>
							<option value="abnormalNippleDischarge">Abnormal Nipple Discharge</option>
							<option value="abnormalVaginalBleeding">Abnormal Vaginal Bleeding</option>
							<option value="allergy">Allergy</option>
							<option value="anxietyDisorder">Anxiety Disorder</option>
							<option value="arthritis">Arthritis</option>
							<option value="asthma">Asthma</option>
							<option value="covid_19">COVID-19</option>
							<option value="drugAddiction">Drug Addiction</option>
							<option value="epilepsy">Epilepsy</option>
							<option value="faintingAttacks">Fainting Attacks</option>
							<option value="fracture">FRACTURE</option>
							<option value="hepatitis">Hepatitis</option>
							<option value="highBloodCholestrol">High Blood Cholestrol</option>
							<option value="hypertension">Hypertension</option>
							<option value="malaria">Malaria</option>
							<option value="meningitis">Meningitis</option>
							<option value="depression">Mental Illness / Depression</option>
							<option value="pneumonia">Pneumonia</option>
							<option value="rapeVictim">Rape Victim</option>
							<option value="recurrentMigrane">Recurrent Migrane</option>
							<option value="sickleCell">Sickle Cell Disease</option>
							<option value="STD">STD</option>
							<option value="surgery">Surgery</option>
							<option value="tuberculosis">Tuberculosis</option>
							<option value="typoid">Typhoid</option>
							<option value="prepicUlcer">Prepic Ulcer Disease</option>
							<option value="ulterineFibriods">Ulterine Fibriods</option>
							<option value="others">Others</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Medical Conditions you have Now / Before 1 <span class="requiredData">**</span></span>
						<select class="TQInput" name="medicCondition1">
							<option value="none">None</option>
							<option value="abnormalHeartBeat">Abnormal Heart Beat</option>
							<option value="abnormalNippleDischarge">Abnormal Nipple Discharge</option>
							<option value="abnormalVaginalBleeding">Abnormal Vaginal Bleeding</option>
							<option value="allergy">Allergy</option>
							<option value="anxietyDisorder">Anxiety Disorder</option>
							<option value="arthritis">Arthritis</option>
							<option value="asthma">Asthma</option>
							<option value="covid_19">COVID-19</option>
							<option value="drugAddiction">Drug Addiction</option>
							<option value="epilepsy">Epilepsy</option>
							<option value="faintingAttacks">Fainting Attacks</option>
							<option value="fracture">FRACTURE</option>
							<option value="hepatitis">Hepatitis</option>
							<option value="highBloodCholestrol">High Blood Cholestrol</option>
							<option value="hypertension">Hypertension</option>
							<option value="malaria">Malaria</option>
							<option value="meningitis">Meningitis</option>
							<option value="depression">Mental Illness / Depression</option>
							<option value="pneumonia">Pneumonia</option>
							<option value="rapeVictim">Rape Victim</option>
							<option value="recurrentMigrane">Recurrent Migrane</option>
							<option value="sickleCell">Sickle Cell Disease</option>
							<option value="STD">STD</option>
							<option value="surgery">Surgery</option>
							<option value="tuberculosis">Tuberculosis</option>
							<option value="typoid">Typhoid</option>
							<option value="prepicUlcer">Prepic Ulcer Disease</option>
							<option value="ulterineFibriods">Ulterine Fibriods</option>
							<option value="others">Others</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Medical Conditions you have Now / Before 2</span>
						<select class="TQInput" name="medicCondition2">
							<option value="none">None</option>
							<option value="abnormalHeartBeat">Abnormal Heart Beat</option>
							<option value="abnormalNippleDischarge">Abnormal Nipple Discharge</option>
							<option value="abnormalVaginalBleeding">Abnormal Vaginal Bleeding</option>
							<option value="allergy">Allergy</option>
							<option value="anxietyDisorder">Anxiety Disorder</option>
							<option value="arthritis">Arthritis</option>
							<option value="asthma">Asthma</option>
							<option value="covid_19">COVID-19</option>
							<option value="drugAddiction">Drug Addiction</option>
							<option value="epilepsy">Epilepsy</option>
							<option value="faintingAttacks">Fainting Attacks</option>
							<option value="fracture">FRACTURE</option>
							<option value="hepatitis">Hepatitis</option>
							<option value="highBloodCholestrol">High Blood Cholestrol</option>
							<option value="hypertension">Hypertension</option>
							<option value="malaria">Malaria</option>
							<option value="meningitis">Meningitis</option>
							<option value="depression">Mental Illness / Depression</option>
							<option value="pneumonia">Pneumonia</option>
							<option value="rapeVictim">Rape Victim</option>
							<option value="recurrentMigrane">Recurrent Migrane</option>
							<option value="sickleCell">Sickle Cell Disease</option>
							<option value="STD">STD</option>
							<option value="surgery">Surgery</option>
							<option value="tuberculosis">Tuberculosis</option>
							<option value="typoid">Typhoid</option>
							<option value="prepicUlcer">Prepic Ulcer Disease</option>
							<option value="ulterineFibriods">Ulterine Fibriods</option>
							<option value="others">Others</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Do you Smoke? <span class="requiredData">**</span></span>
						<select class="TQInput" name="smoker">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Do you take Alcohol? <span class="requiredData">**</span></span>
						<select class="TQInput" name="alcohols">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Any Family History of Hypertension</span>
						<select class="TQInput" name="hypertension">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Any Family History of Epilepsy <span class="requiredData">**</span></span>
						<select class="TQInput" name="epilepsy">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Any Family History of Mental illness <span class="requiredData">**</span></span>
						<select class="TQInput" name="mentalIllness">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Any Family History of Breast Cancer</span>
						<select class="TQInput" name="breastCancer">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
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