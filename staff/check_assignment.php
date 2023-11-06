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
				$goinSession = $row['onSession'];
				$goinSemester = $row['semester'];
			}
		}
		//inputing assignment
		if (isset($_POST['submit']) && !empty($_POST['CCodes']) && !empty($_POST['question']) && !empty($_POST['topic'])) {
			$course = htmlentities($_POST['CCodes']);
			$question = htmlentities($_POST['question']);
			$topic = htmlentities($_POST['topic']);
			$insertQuery = mysqli_query($db_conx, "INSERT INTO staff_assign(id, lecture_id, course_code, topic, query, students, answer, submit_time, onSession, onSemester, dateMade) VALUES(NULL, '$currentStaID', '$course', '$topic', '$question', '', '', '', '$goinSession', '$goinSemester', NOW())");
			if ($insertQuery) {
				$report .= "<div style='color:green;'>Question sent</div>";
			} else {
				$report .= "<div style='color:red;'>Question not sent</div>";
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
	<title>Assignment dashboard</title>
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
		.appoinSec {
		    margin-bottom: 25px;
		}
		.PABText01 {
		    font-size: 120%;
		    font-weight: 300;
		    color: darkred;
		    padding-bottom: 9px;
		    border-bottom: 1px solid darkred;
		    margin-bottom: 20px;
		}
		.appCover {
		    border: 1px solid grey;
    		width: 85%;
		}
		.sn {
		    width: 10%;
		    border-right: 1px solid grey;
		    padding: 5px;
		    text-align: center;
		}
		.bigWeight {
		    font-weight: 600;
		}
		.bigWidth {
		    width: 25%;
		    padding: 5px;
		    border-right: 1px solid grey;
		    text-align: center;
		}
		.bigWidth2 {
			width: 50%;
		    padding: 5px;
		    border-right: 1px solid grey;
		    text-align: center;
		}
		.bigWidth3 {
		    padding: 5px;
		    text-align: center;
		    width: 15%;
		}
		.sn2 {
			width: 5%;
		    border-right: 1px solid grey;
		    padding: 5px;
		    text-align: center;
		}
		.bigWidth4 {
			width: 17%;
		    padding: 5px;
		    border-right: 1px solid grey;
		    text-align: center;
		}
		.bigWidth5 {
			width: 30%;
		    padding: 5px;
		    border-right: 1px solid grey;
		    text-align: center;
		}
		.dates {
		    padding: 5px;
		    width: 12%;
		    border-right: 1px solid grey;
		    text-align: center;
		}
		.ansLink {
		    background-color: #1d366fbd;
		    color: white;
		    cursor: pointer;
		    padding: 5px;
		    position: absolute;
		    left: 35px;
		    top: 9px;
		    border-radius: 5px;
		    font-size: 80%;
		}
	</style>
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Assignments >> submitted assignments</div>
			<div class="floatR">Department : <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div style="margin-top: 10px; margin-bottom: 10px;"><?php echo $report;?></div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="appoinSec">
					<div class="PABText01">Incoming Assignment</div>
					<div style="margin-bottom: 20px;">
						<?php 
						//show lecture courses from data base
						$selectCourseInfo =mysqli_query($db_conx, "SELECT * FROM courseInfo WHERE lecture_Id = '$currentStaID'");
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
							echo "<div class='clearing'></div>";
						}
						?>
					</div>
					<div class="appCover bigWeight">
						<div class="sn floatL">S/N</div>
						<div class="bigWidth floatL">Topic</div>
						<div class="bigWidth2 floatL">Question</div>
						<div class="bigWidth3 floatL">Details</div>
						<div class="clearing"></div>
					</div>
					<?php
						//show students doing this course
						$m = 0;
						do {
							if (isset($_POST[$initializeCourses[$m]])) {
								$SMStudents = mysqli_query($db_conx, "SELECT * FROM staff_assign WHERE course_code= '$CValues[$m]' AND lecture_id= '$currentStaID' AND score =''");
								$CMStudents = mysqli_num_rows($SMStudents);
								if ($CMStudents > 0) {
									$n = 1;
									while ($row = mysqli_fetch_array($SMStudents)) {
										$topicQuery = $row['topic'];
										$questn = $row['query'];
										$id = $row['id'];
										$_SESSION['query'] = $row['query'];
										echo "<div class='appCover'>
												<div class='sn floatL'>$n</div>
												<div class='bigWidth floatL'>$topicQuery</div>
												<div class='bigWidth2 floatL'>$questn</div>
												<div class='bigWidth3 floatL' style= 'position: relative;'>
													<a href= 'answers.php?n=$id' class= 'ansLink'>answers</a>
												</div>
												<div class='clearing'></div>
											</div>";
										++$n;
									}
									/*
									$KaStudents = explode(",", $students);
									$k = 1;
									for ($l=0; $l < count($KaStudents) && $k < count($KaStudents); $l++) { 
										echo "<div class='forBBline'>
											<div class='conText'>$k</div>
											<div class='conText2'>$KaStudents[$l]</div>
										</div>";
										++$k;
									}
									*/
								}
							}
							++$m;
						} while ($m < count($initializeCourses));
					?>
				</div>
			</form>
			<div class="appoinSec">
				<div class="PABText01">Graded Assignment</div>
				<div class="appCover bigWeight">
					<div class="sn2 floatL">S/N</div>
					<div class="bigWidth4 floatL">Student No</div>
					<div class="bigWidth5 floatL">Name</div>
					<div class="dates floatL">About</div>
					<div class="dates floatL">Set Date</div>
					<div class="dates floatL">Time</div>
					<div class="dates floatL">Sent Date</div>
					<div class="clearing"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>