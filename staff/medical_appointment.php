<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPas = $_SESSION['password'];

	if ($currentStaID != "" && $currentPas != "") {
		$selectStuData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentPas' LIMIT 1";
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
		//fix medical appointment
		if (isset($_POST['submit']) && !empty($_POST['date1']) && !empty($_POST['appointment']) && !empty($_POST['time'])) {
			$appointment = htmlentities($_POST['appointment']);
			$date1 = htmlentities($_POST['date1']);
			$date2 = htmlentities($_POST['date2']);
			$time = htmlentities($_POST['time']);
			$addApointment = mysqli_query($db_conx, "INSERT INTO appointment(id, type, appointment, student, lecturer, preferred_1, preferred_2, authorize_date, fixed_time, from_who, done, date_made) VALUES(NULL, 'medical', '$appointment', '0', '$currentStaID', '$date1', '$date2', '$date1', '$time', '$currentStaID', '0', NOW())");
			if ($addApointment) {
				$report .="<div style='color: green;'>appointment fixed</div>";
			} else {
				$report .="<div style='color: red;'>appointment fixed</div>";
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
	<?php include_once("../include/staffPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Appointments >> medical Appointment</div>
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
							<span>Preferred date 1 : </span>
							<input type="date" name="date1">
						</div>
						<div class="floatR">
							<span>Preferred date 2 : </span>
							<input type="date" name="date2">
						</div>
						<div style="clear: both;"></div>
					</div>
					<div style="margin-top: 25px;">
						<span>Time : </span>
						<input type="time" name="time">
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