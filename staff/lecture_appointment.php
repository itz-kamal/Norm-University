<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPas = $_SESSION['password'];

	if ($currentStaID != "" && $currentPas != "") {
		$report = "";
		$selectStuData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentPas' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectStuData);
		$checkStu = mysqli_num_rows($selectQuery);
		if ($checkStu > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart =  strtoupper($row['department']);
				$PPName = $row['passport'];
			}
		}
		//fix appointment with lecturer
		if (isset($_POST['submit']) && !empty($_POST['student']) && !empty($_POST['appointment']) && !empty($_POST['date1']) && !empty($_POST['time'])) {
			$appointment = htmlentities($_POST['appointment']);
			$student = htmlentities($_POST['student']);
			$date = htmlentities($_POST['date1']);
			$course = htmlentities($_POST['lecturer']);
			$time = htmlentities($_POST['time']);
			//now fix appointment
			$addApointment = mysqli_query($db_conx, "INSERT INTO appointment(id, type, appointment, student, lecturer, preferred_1, preferred_2, authorize_date, fixed_time, from_who, done, date_made) VALUES(NULL, 'lecture', '$appointment', '$student', '$currentStaID', '$date', '$date', '$date', '$time', '$currentStaID', '0', NOW())");
			if ($addApointment) {
				$report .="<div style='color: green'>appointment fixed</div>";
			} else {
				$report .="<div style='color: red'>appointment not fixed</div>";
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
		.studentNum {
		    background-color: #eeeeee;
		    padding: 5px;
		    border: 1px solid #808080;
		    border-radius: 7px;
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
		.lecTag {
		    display: inline-block;
    		width: 8%;
		}
	</style>
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
				<div style="margin-bottom: 15px;"><?php echo $report; ?></div>
				<div>Fix an Appointment with your lecturer</div>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div style="margin-top: 15px;">
						<span class="lecTag">Student : </span>
						<span><input type="text" name="student" class="studentNum" placeholder="student number"></span>
					</div>
					<div class="aboutCon">
						<div class="aboutTag floatL">About : </div>
						<div><textarea class="writeUp" name="appointment"></textarea></div>
						<div style="clear: both;"></div>
					</div>
					<div class="dateSec">
						<div class="floatL">
							<span>Preferred date : </span>
							<input type="date" name="date1">
						</div>
						<div class="floatL" style="margin-left: 50px;">
							<span>Time : </span>
							<input type="time" name="time">
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