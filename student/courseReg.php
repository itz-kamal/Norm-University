<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStuMatNo = $_SESSION['matricNo'];
	$currentStuPas = $_SESSION['password'];

	if ($currentStuMatNo != "" && $currentStuPas != "") {
		$level = "";
		$selectStuData = "SELECT * FROM studentsIn_normUni WHERE matricNo = '$currentStuMatNo' AND password = '$currentStuPas' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectStuData);
		$checkStu = mysqli_num_rows($selectQuery);
		if ($checkStu > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = $row['department'];
				$PPName = $row['passport'];
				$level = $row['level'];
				$semester = $row['semester'];
				$fNo_and_dno = $row['fNo_with_dNo'];
				$onSession = $row['onSession'];

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
	<title>Courses registration</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		table {
			border-collapse: collapse;
		}
		th, td {
			border: 1px solid black;
			padding: 10px;
		}
		.subBtn {
		    margin: 40px 45% 0;
		    padding: 11px;
		    background-color: #033f63e6;
		    border-radius: 5px;
		    color: white;
		    border: none;
		    font-size: 90%;
		    cursor: pointer;
		}
	</style>
</head>
<body>
	<?php include_once("../include/stuPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Courses >> Course registration</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
				<table>
					<tr>
						<th>S/N</th>
						<th>select</th>
						<th>course code</th>
						<th>course title</th>
						<th>units</th>
						<th>status</th>
					</tr>
				<?php
				//show student level courses
				$dbCourse = "coursesNorm_".$level."level";
				$SCourse = mysqli_query($db_conx, "SELECT * FROM $dbCourse WHERE fNo_with_dNo = '$fNo_and_dno' AND semester = '$semester'"); 
				$CCourse = mysqli_num_rows($SCourse);
				$x = 1;
				//gets possible courses this student can offer
				if ($CCourse > 0) {
					$allCourses = array();
					while ($row = mysqli_fetch_array($SCourse)) {
						$CCode = $row['course_code'];
						$CTitle = $row['course_title'];
						$CUnit = $row['course_unit'];
						$status = $row['status'];
						//show courses available for this student
						echo "<tr>
							<td>$x</td>
							<td><input type='checkbox' name='course$x' value='$CCode'></td>
							<td>$CCode</td>
							<td><input type='hidden' name='course$x$x$x' value='$CTitle'/>$CTitle</td>
							<td><input type='hidden' name='course$x$x$x$x' value='$CUnit'/>$CUnit</td>
							<td><input type='hidden' name='course$x$x$x$x$x' value='$status'/>$status</td>
							</tr>";
						++$x;
						array_push($allCourses, $CCode);
					}
				}
				if (isset($_POST['submit'])) {
					$b = 1;
				//course code and titles
					$dbCodes = "";
					$dbTitles = "";
					$dbUnits = "";
					$dbStatus = "";
					while ($b <= $x) {
					//get selected courses alone
						if (!empty($_POST['course'.$b]) && !empty($_POST['course'.$b.$b.$b])) {
						//course code handle
							$cHandler=$_POST['course'.$b];
							$CSplit = $cHandler.",";
						//course title handler
							$tHandler = $_POST['course'.$b.$b.$b];
							$TSplit = $tHandler.",";
						//course unit handler
							$uHandler = $_POST['course'.$b.$b.$b.$b];
							$USplit = $uHandler.",";
						//course status handler
							$sHandler = $_POST['course'.$b.$b.$b.$b.$b];
							$SSplit = $sHandler.",";
						//select students offering this course so to can add this student for the lecturer
							$selectCourseExist = mysqli_query($db_conx, "SELECT students_id FROM courseInfo WHERE course_code = '$cHandler' LIMIT 1");
							$checkExist = mysqli_num_rows($selectCourseExist);
							if ($checkExist > 0) {
								while ($row = mysqli_fetch_array($selectCourseExist)) {
									$allStudents = $row['students_id'];
								//put all students into an array so as no to add them twice
									$kaboom1 = explode(",", $allStudents);
									for ($l=0; $l < count($kaboom1); $l++) { 
										if ($kaboom1[$l] == $currentStuMatNo) {
											$l = count($kaboom1);
										} else if ($l == (count($kaboom1) - 1) && $kaboom1[$l] != $currentStuMatNo) {
										//if not reg before add student to this lecturer
											$withThisStudent = $allStudents.$currentStuMatNo.",";
											$updateCOffer = mysqli_query($db_conx, "UPDATE courseInfo SET students_id = '$withThisStudent' WHERE course_code = '$cHandler' LIMIT 1");
										}
									}
								}
							}
						//all course code and titles registered by this student with units
							$dbCodes .= $CSplit;
							$dbTitles .= $TSplit;
							$dbUnits .= $USplit;
							$dbStatus .= $SSplit;
						} else {
						//getting the non selected courses
							$seCo = array();
							for ($i=1; $i < $x; $i++) { 
								if (isset($_POST['course'.$i])) {
									array_push($seCo, $_POST['course'.$i]);
								}
							}
							for ($m=0; $m < $x; ++$m) { 
								$cor1 = $allCourses[$m];
								for ($n=0; $n <= count($seCo); ++$n) { 
									$cor2 = "".$seCo[$n];
									//check for non selected courses
									if ($cor1 != $cor2  && $n == count($seCo)) {
									//remove this student from this course in lecturer
										$SSOTCourse = mysqli_query($db_conx, "SELECT students_id FROM courseInfo WHERE course_code = '$allCourses[$m]'");
										$CSOTCourse = mysqli_num_rows($SSOTCourse);
										if ($CSOTCourse > 0) {
											while ($row = mysqli_fetch_array($SSOTCourse)) {
												$ASOTCourse = $row['students_id'];
												$ESOTCourse = explode(",", $ASOTCourse);
												$NASOTCourse = "";
												for ($p=0; $p < count($ESOTCourse); $p++) { 
													if ($ESOTCourse[$p] == $currentStuMatNo) {
														//dont add this student for this course
													} else if ($ESOTCourse[$p] != "") {
														//add other students
														$NASOTCourse .= $ESOTCourse[$p].",";
													}
												}
											}
											$UANSOTCourse = mysqli_query($db_conx, "UPDATE courseInfo SET students_id = '$NASOTCourse' WHERE course_code = '$allCourses[$m]'");
										}
									} else if ($cor1 == $cor2) {
									//if offering course do nothing
										$n = count($seCo) + 1;
									}
								}
							}
						}
						++$b;
					}
					//check if student already registered to update or register new student 
					$selcReged = mysqli_query($db_conx, "SELECT course_code FROM courseReg WHERE matricNo = '$currentStuMatNo' AND the_session = '$onSession' LIMIT 1");
					$checkReged = mysqli_num_rows($selcReged);
					if ($checkReged > 0) {
					//update offering courses for this session
						$updateReg = mysqli_query($db_conx, "UPDATE courseReg SET course_code='$dbCodes', course_title='$dbTitles', units='$dbUnits', status='$dbStatus' WHERE matricNo = '$currentStuMatNo' LIMIT 1");

						if ($updateReg) {
							$report .= "<div style='color:green;'>Course registration successful</div>";
						} else {
							$report .= "<div style='color:red;'>Course registration not successful</div>";
						}
					} else {
					//reg student courses for the first time this seesion
						$insertCouse = mysqli_query($db_conx, "INSERT INTO courseReg(id, matricNo, level, semester, the_session, course_code, course_title, units, status, date_made) VALUES (NULL, '$currentStuMatNo', '$level', '$semester', '$onSession', '$dbCodes', '$dbTitles', '$dbUnits', '$dbStatus', NOW())");
						if ($insertCouse) {
							$report .= "<div style='color:green;'>Course registration successful</div>";
						} else {
							$report .= "<div style='color:red;'>Course registration not successful</div>";
						}
					}
				}
				
				?>
				</table>
				<div><input type="submit" name="submit" value="submit" class="subBtn"></div>
			</form>
			<div style="margin: 10px 0;"><?php echo $report; ?></div>
		</div>
	</div>
</body>
</html>