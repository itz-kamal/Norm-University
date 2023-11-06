<?php
session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPass = $_SESSION['password'];
	if ($currentStaID != "" && $currentPass != "") {
		$selectStuData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentPass' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectStuData);
		$checkStu = mysqli_num_rows($selectQuery);
		if ($checkStu > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = $row['department'];
				$PPName = $row['passport'];
				$onSession = $row['onSession'];
			}
		}
		//insert results
		if (isset($_POST['submitResult'])) {
			$courSubmitted = $_POST['courseRes'];
			$sn = $_POST['lastSn'];
			$preName = "stu";
			$thisStudent = "";
			$cA = "";
			$examScore = "";
			$totalScore = "";
			$grades = "";
			for ($i=0; $i < $sn; ++$i) {
				//student
				$studentName = $preName."".$i."".$i."".$i."".$i."".$i;
				$studentId = htmlentities($_POST[$studentName]);
				$thisStudent .= $studentId.",";
				//ca values
				$caName = $preName."".$i;
				$caNameValue = htmlentities($_POST[$caName]);
				$cA .= $caNameValue.",";
				//exam values
				$examName = $preName."".$i."".$i;
				$exNameValue = htmlentities($_POST[$examName]);
				$examScore .= $exNameValue.",";
				//total
				$totalName = $preName."".$i."".$i."".$i;
				$totalValue = htmlentities($_POST[$totalName]);
				$totalScore .= $totalValue.",";
				//grade values
				$gradeName = $preName."".$i."".$i."".$i."".$i;
				$gradeValue = htmlentities($_POST[$gradeName]);
				$grades .= $gradeValue.",";
			}
			//check if result has being posted
			$selResult = mysqli_query($db_conx, "SELECT course_code FROM course_result WHERE course_code = '$courSubmitted'");
			$checkResult = mysqli_num_rows($selResult);
			if ($checkResult > 0) {
				//update the result
				$updateResult = mysqli_query($db_conx, "UPDATE course_result SET student_ids = '$thisStudent', ca = '$cA', exam = '$examScore', total = '$totalScore', grade = '$grades' WHERE course_code = '$courSubmitted' ");
				if ($updateResult) {
					$report .= "<div style='color:green;'>results sent</div>";
				} else {
				$report .= "<div style='color:red;'>results not sent</div>";
				}
			} else {
				//send results
				$insertResult = mysqli_query($db_conx, "INSERT INTO course_result(id, course_code, lecturer, student_ids, ca, exam, total, grade, the_session, date_made) VALUES (NULL, '$courSubmitted', '$currentStaID', '$thisStudent', '$cA', '$examScore', '$totalScore', '$grades', '$onSession', NOW())");
				if ($insertResult) {
					$report .= "<div style='color:green;'>results sent</div>";
				} else {
					$report .= "<div style='color:red;'>results not sent</div>";
				}
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
	<title>Post Result</title>
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
		.PResSText01 {
		    margin-bottom: 17px;
    		font-size: 85%;
    		color: gray;
		}
		.hideCourse {
			display: none;
		}
		.studentsOffering {
	       width: 90%;
    		margin-top: 2%;
    		border: 1px solid #676666;
		}
		.forBBline {
		    border-bottom: 1px solid #7b7b7b;
		}
		.iterateText {
			text-align: center;
		    width: 4%;
		    padding: 8px;
		    font-size: 90%;
		    display: inline-block;
		    border-right: 1px solid black;
		}
		.conText {
		    text-align: center;
		    width: 12%;
		    padding: 8px;
		    font-size: 90%;
		    display: inline-block;
		    border-right: 1px solid black;
		}
		.conText2 {
		    padding: 8px;
		    width: 32%;
		    display: inline-block;
		    text-align: center;
		    border-right: 1px solid black;
		}
		.headFont {
			font-weight: 600;
		}
		.scoreIn {
		    width: 22%;
    		border: none;
    		border-bottom: 1px solid black;
		}
		.hide {
		    width: 100%;
		    color: brown;
		    border: none;
		    text-align: center;
		    outline: none;
		    cursor: default;
		}
		.runBtn {
		    display: inline-block;
		    border: 1px solid gray;
		    padding: 6px 12px;
		    font-size: 85%;
		    border-radius: 5px;
		    margin-right: 30px;
		    background-color: #6b6a6af0;
		    color: white;
		    cursor: pointer;
		}
		.subBtn {
		    cursor: pointer;
    		padding: 5px 8px;
    		text-align: center;
		}
		.textColo {
			color: brown;
		}
		.noOfStu {
			visibility: hidden;
		}
	</style>
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Post Result</div>
			<div class="floatR">Department : <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div style="margin-bottom: 20px;"><?php echo $report; ?></div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="PResSText01">Enter student grades</div>
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
					}
				?>
				<div class="clearing"></div>
				<div class="studentsOffering">
					<div class="forBBline">
						<div class="iterateText headFont">S/N</div>
						<div class="conText headFont">Matric No</div>
						<div class="conText2 headFont">Name</div>
						<div class="conText headFont">C/A score</div>
						<div class="conText headFont">Exam score</div>
						<div class="conText headFont">Total</div>
						<div class="conText headFont">Grade</div>
					</div>
					<?php
					//show students doing this course
					$m = 0;
					do {
						if (isset($_POST[$initializeCourses[$m]])) {
							//get the course submmitted but hide it
							echo "<div><input class='hideCourse' name='courseRes' value='$CValues[$m]' /></div>";
							$SMStudents = mysqli_query($db_conx, "SELECT students_id FROM courseInfo WHERE course_code='$CValues[$m]'");
							$CMStudents = mysqli_num_rows($SMStudents);
							if ($CMStudents > 0) {
								while ($row = mysqli_fetch_array($SMStudents)) {
									$students = $row['students_id'];
								}
								$KaStudents = explode(",", $students);
								//variable k is for iteration of number of students
								$k = 1;
								$idName = "stu";
								for ($l=0; $l < count($KaStudents) && $k < count($KaStudents); $l++) { 
									//get student name
									$SThiStuName = mysqli_query($db_conx, "SELECT lastName, firstName FROM studentsIn_normUni WHERE matricNo='$KaStudents[$l]' ");
									$cheThisStu = mysqli_num_rows($SThiStuName);
									//php name for ca and exam score
									$phpName1 = $idName."".$l;
									$phpName2 = $idName."".$l."".$l;
									echo $phpName;
									if ($cheThisStu > 0) {
										while ($row = mysqli_fetch_array($SThiStuName)) {
											$stuLastName = strtoupper($row['lastName']);
											$stuFirstName = $row['firstName'];
										}
										echo "<div class='forBBline'>
										<div class='iterateText' id='lastStu'><input class='hide' name='lastSn' value='$k' /></div>
										<div class='conText'><input class='hide' name='$idName$l$l$l$l$l' value='$KaStudents[$l]' /></div>
										<div class='conText2'>$stuLastName $stuFirstName</div>
										<div class='conText'><input type='text' name='$phpName1' class='scoreIn' id='$idName$l'/></div>
										<div class='conText'><input type='text' name='$phpName2' class='scoreIn' id='$idName$l$l'/></div>
										<div class='conText textColo'><input id='$idName$l$l$l' class='hide' name='$idName$l$l$l' value='00' /></div>
										<div class='conText textColo'><input id='$idName$l$l$l$l' class='hide' name='$idName$l$l$l$l' value='--' /></div>
									</div>";
									++$k;
									}
									
								}
							}
						}
						++$m;
					} while ($m < count($initializeCourses));
					?>
				</div>
				<span class="noOfStu" id="lastSn"> <?php echo $k; ?></span>
				<div style="margin-top: 21px">
					<span class="runBtn" onclick="runResult()">run</span>
					<span><input type="submit" name="submitResult" value="submit" class="subBtn"></span>
					<div class="clearing"></div>
				</div>
			</form>
		</div>
	</div>
<script src="../js/thisStaff.js"></script>
</body>
</html>
