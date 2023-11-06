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
		$report = "";
		//fix medical appointment
		if (isset($_POST['submit']) && !empty($_POST['date']) && !empty($_POST['appointment'])) {
			$appointment = htmlentities($_POST['appointment']);
			$date = htmlentities($_POST['date']);
			$timing = htmlentities($_POST['timing']);
			$addApointment = mysqli_query($db_conx, "INSERT INTO appointment(id, type, appointment, student, lecturer, preferred_date, fixed_time, from_who, done, date_made) VALUES(NULL, 'medical', '$appointment', '$currentStuMatNo', '0', '$date', '$timing', '$currentStuMatNo', '0', NOW())");
			if ($addApointment) {
				$report .="<div style='color: green;'>appointment fixed</div>";
			} else {
				$report .="<div style='color: red;'>appointment not fixed</div>";
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
	<title>Appointment</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		.aboutCon {
		    margin-top: 15px;
    		margin-bottom: 15px;
		}
		.aboutTag {
		    width: 7%;
		}
		.writeUp {
		    width: 38%;
		    height: 97px;
		    resize: none;
		    font-size: 110%;
		    font-family: sans-serif;
		}
		.dateSec {
		    width: 63%;
		}
		.btn {
		    margin-top: 25px;
		    padding: 7px;
		    color: white;
		    background-color: grey;
		    border: none;
		    font-size: 79%;
		    border-radius: 5px;
		    cursor: pointer;
		}
	</style>
</head>
<body>
	<?php include_once("../include/stuPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Appointments</div>
				<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div style="margin-bottom: 15px;"><?php echo $report; ?></div>
				<div>Fix a Medical Appointment</div>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="aboutCon">
						<div class="aboutTag floatL">About : </div>
						<div><textarea class="writeUp" name="appointment"></textarea></div>
						<div style="clear: both;"></div>
					</div>
					<div class="dateSec">
						<div class="floatL">
							<span>Date : </span>
							<input type="date" name="date">
						</div>
						<div class="floatR">
							<span>Time : </span>
							<input type="time" name="timing">
						</div>
						<div style="clear: both;"></div>
					</div>
					<div>
						<input type="submit" name="submit" class="btn">
					</div>
				</form>
			</div>
		</div>
		<div class="clearing"></div>
	</div>
</body>
</html>