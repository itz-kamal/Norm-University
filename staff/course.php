<?php
session_start();
	include_once("../include/connect.php");
	//identify the current student
	$currentStaff = $_SESSION['staffID'];
	$currentStaffPass = $_SESSION['password'];
	if ($currentStaff != "" && $currentStaffPass != "") {
		$selectStuData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaff' AND password = '$currentStaffPass' LIMIT 1";
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
	<title>My courses</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		.listOfCourses {
		    width: 9%;
		    text-align: center;
		    background: #c1c0c0;
		    margin-right: 8%;
		    font-size: 83%;
		    border-radius: 5px;
		}
		.courseInfo {
	        border: none;
    		padding: 7px;
    		color: #383737;
    		background: #c1c0c0;
    		cursor: pointer;
		}
		.schemeOption {
		    padding: 2px;
    		margin-right: 30px;
		}
		.TimeTableCon {
	        border: 1px solid #403f3f;
 		   width: 68%;
		}
		.dayTime {
    		border-bottom: 1px solid black;
		}
		.day {
		    padding: 1.5%;
    		width: 16%;
    		display: inline-block;
		}
		.toTeachCourse {
		    display: block;
    		border: none;
    		width: 100%;
    		border-bottom: 1px solid grey;
		}
		.lectureTime {
		    margin-top: 4%;
    	    width: 70%;
    		margin-left: 15%;
    		border: none;
    		border-bottom: 1px solid grey;
		}
		.lectureDuration {
		    padding: 1.5%;
		    display: inline-block;
    		border-left: 1px solid #585858;
    		width: 16%;
		}
		.UpdateTimeTable {
		    float: right;
		    margin-top: 20px;
		    padding: 9px;
		    background: #848282;
		    border: none;
		    font-size: 85%;
		    color: white;
		    cursor: pointer;
		    border-radius: 6px;
		}
		.studentsOffering {
		    width: 40%;
		    margin-top: 2%;
		    border: 1px solid #676666;
		}
		.forBBline {
		    border-bottom: 1px solid #7b7b7b;
		}
		.conText {
		    padding: 1%;
		    width: 20%;
		    display: inline-block;
		    border-right: 1px solid black;
		}
		.conText2 {
			padding: 1%;
		    width: 56%;
		    display: inline-block;
		}
	</style>
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Courses</div>
			<div class="floatR">Department : <?php echo strtoupper($depart); ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div>
				<form action="<?php echo$_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="CSASPFocus">My courses</div>
				<div class="CSASPFDiv">
						<?php 
						//show lecture courses from data base
						$selectCourseInfo =mysqli_query($db_conx, "SELECT * FROM courseInfo WHERE lecture_Id = '$currentStaff'");
						$checkCourseInfo = mysqli_num_rows($selectCourseInfo);
						if ($checkCourseInfo > 0) {
							$i = 1;
							$initializeCourses = array();
							$CValues = array();
							while ($row = mysqli_fetch_array($selectCourseInfo)) {
								$course_code = $row['course_code'];
								//create loop for course names
								$courseName = "course".$i;
								//list of course head by lecturer
								echo "<div class='listOfCourses floatL'><input type='submit' name='$courseName' value='$course_code' class='courseInfo'></div>";
								array_push($initializeCourses, $courseName);
								array_push($CValues, $course_code);
								++$i;
							}
						}
						?>
					<div class="clearing"></div>
					<div class="studentsOffering">
						<div class="forBBline">
							<div class="conText ">S/N</div>
							<div class="conText2 ">Matric No</div>
						</div>
						<?php
						//show students doing this course
						$m = 0;
						do {
							if (isset($_POST[$initializeCourses[$m]])) {
								$SMStudents = mysqli_query($db_conx, "SELECT students_id FROM courseInfo WHERE course_code='$CValues[$m]'");
								$CMStudents = mysqli_num_rows($SMStudents);
								if ($CMStudents > 0) {
									while ($row = mysqli_fetch_array($SMStudents)) {
										$students = $row['students_id'];
									}
									$KaStudents = explode(",", $students);
									$k = 1;
									for ($l=0; $l < count($KaStudents) && $k < count($KaStudents); $l++) { 
										echo "<div class='forBBline'>
											<div class='conText'>$k</div>
											<div class='conText2'>$KaStudents[$l]</div>
										</div>";
										++$k;
									}
								}
							}
							++$m;
						} while ($m < count($initializeCourses));
						?>
					</div>
				</div>
				<!--
				<div class="CSASPFocus">Time-table</div>
				<div class="CSASPFDiv">
					<div class="TimeTableCon">
						<div class="dayTime">
							<span class="day">Monday</span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
						</div>
						<div class="dayTime">
							<span class="day">Tuesday</span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
						</div>
						<div class="dayTime">
							<span class="day">Wednesday</span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
						</div>
						<div class="dayTime">
							<span class="day">Thursday</span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
						</div>
						<div class="dayTime">
							<span class="day">Friday</span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
							<span class="lectureDuration"><input type="text" name="" class="toTeachCourse"><input type="text" name="" class="lectureTime"></span>
						</div>
						<div><input type="submit" name="" class="UpdateTimeTable" value="Set Time-table"></div>
					</div>
					<div class="clearing"></div>
				</div>
				-->
				</form>
			</div>
		</div>
	</div>
</body>
</html>