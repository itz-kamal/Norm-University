<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStuMatNo = $_SESSION['matricNo'];
	$currentStuPas = $_SESSION['password'];

	if ($currentStuMatNo != "" && $currentStuPas != "") {
		$report = "";
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
		//fix appointment with lecturer
		if (isset($_POST['submit']) && !empty($_POST['lecturer']) && !empty($_POST['appointment']) && !empty($_POST['date'])) {
			$appointment = htmlentities($_POST['appointment']);
			$date = htmlentities($_POST['date']);
			$time = htmlentities($_POST['timeing']);
			$course = htmlentities($_POST['lecturer']);
			$SLecId = mysqli_query($db_conx, "SELECT lecture_Id FROM courseInfo WHERE course_code='$course' ");
			$checkCouCode = mysqli_num_rows($SLecId);
			if ($checkCouCode > 0) {
				while ($row = mysqli_fetch_array($SLecId)) {
					$staffID = $row['lecture_Id'];
				}
				//now fix appointment
				$addApointment = mysqli_query($db_conx, "INSERT INTO appointment(id, type, appointment, student, lecturer, preferred_date, fixed_time, from_who, done, date_made) VALUES(NULL, 'lecture', '$appointment', '$currentStuMatNo', '$staffID', '$date', '$time', '$currentStuMatNo', '0', NOW())");
				if ($addApointment) {
					$report .="<div style='color: green'>appointment fixed</div>";
				} else {
					$report .="<div style='color: red'>appointment not fixed</div>";
				}
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
		.lectNames {
			background-color:#eeeeee;
		}
		.hide {
			visibility: hidden;
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
	<?php include_once("../include/stuPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Appointments >> with lecturer</div>
				<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div style="margin-bottom: 15px;"><?php echo $report; ?></div>
				<div>Fix an Appointment with your lecturer</div>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div style="margin-top: 15px;">
						<span class="lecTag">Lecturer : </span>
						<select class="lectNames" name="lecturer">
						<?php
						//all students courses
						$SStuCourses = mysqli_query($db_conx, "SELECT course_code FROM courseReg WHERE matricNo='$currentStuMatNo' ");
						$checkRegCourse = mysqli_num_rows($SStuCourses);
						if ($checkRegCourse > 0) {
							while ($row = mysqli_fetch_array($SStuCourses)) {
								$MyCouCodes = $row['course_code'];
							}
						}
						$splitCodes = explode(",", $MyCouCodes);
						for ($i=0; $i < count($splitCodes); ++$i) { 
							$eachCode = $splitCodes[$i];
							//select all my lectures
							$SLecturer = mysqli_query($db_conx, "SELECT codeLectu.*, aboutLectu.* FROM courseInfo AS codeLectu INNER JOIN staffsInto_normUni AS aboutLectu ON codeLectu.lecture_Id = aboutLectu.staffID AND codeLectu.course_code = '$eachCode' ");
							$checkLecturer = mysqli_num_rows($SLecturer);
							if ($checkLecturer > 0) {
								while ($row = mysqli_fetch_assoc($SLecturer)) {
									$title = $row['title'];
									$lastNameLectu = strtoupper($row['lastName']);
									$firstNameLectu = strtoupper($row['firstName']);
									echo "<option value='$eachCode'>$title $lastNameLectu $firstNameLectu, $eachCode</option>";
								}
							}
						}
						?>
						</select>
					</div>
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
							<input type="time" name="timeing">
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