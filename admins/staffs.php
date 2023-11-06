<?php
include_once("../include/connect.php");

//assign course to a staff
if (isset($_POST['btn2']) && !empty($_POST['staffId']) && !empty($_POST['course1'])) {
	$staffId = htmlentities($_POST['staffId']);
	$course1 = htmlentities($_POST['course1']);
	$course2 = htmlentities($_POST['course2']);
	$course3 = htmlentities($_POST['course3']);
	$course4 = htmlentities($_POST['course4']);
	$course5 = htmlentities($_POST['course5']);
	$course6 = htmlentities($_POST['course6']);

	
	$assignCourses = "".$course1.",".$course2.",".$course3.",".$course4.",".$course5.",".$course6.",";
	//check if staff alread has a course
	$selectStaff = mysqli_query($db_conx, "SELECT staffID FROM staffCourseReg WHERE staffID = '$staffId' LIMIT 1");
	$checkStaff = mysqli_num_rows($selectStaff);
	if ($checkStaff > 0) {
		$UStaffCourse = mysqli_query($db_conx, "UPDATE staffCourseReg SET course_code = '$assignCourses' WHERE staffID = '$staffId' LIMIT 1");
		if ($UStaffCourse) {
			$report .= "<div style='color:green;'>Course Registration successful</div>";
		} else {
			$report .= "<div style='color:red;'>Course Registration unsuccessful</div>";
		}
	} else {
		$insertCourses = mysqli_query($db_conx, "INSERT INTO staffCourseReg(id, staffID, course_code, date_made) VALUES(NULL, '$staffId', '$assignCourses', NOW())");
		if ($insertCourses) {
			$report .= "<div style='color:green;'>Course Registration successful</div>";
		} else {
			$report .= "<div style='color:red;'>Course Registration unsuccessful</div>";
		}
	}
	//enter the course header info into a second table so students doing the course can be easily added up for each level
	$level = 100;
	for ($i=1; $i < 7; $i++) { 
		$cour = "course".$i;
		$lala = $_POST[$cour];
	//get the level and semester of each course to insert into course info
		if (!empty($lala)) {
			$j = 1;
			//to insert only once
			while ( $j == 1) {
				$levelTableName = "coursesNorm_".$level."level";
			//check this course from different tables until found
				$selectSemester = mysqli_query($db_conx, "SELECT semester, course_title FROM $levelTableName WHERE course_code = '$lala' LIMIT 1");
				$checkSemester = mysqli_num_rows($selectSemester);
				if ($checkSemester > 0) {
					while ($row = mysqli_fetch_array($selectSemester)) {
						$semester = $row['semester'];
						$courseTitle = $row['course_title'];
					}
					//check if course is taken so you can just update the lecturer ID
					$selCouInf = mysqli_query($db_conx, "SELECT course_code FROM courseInfo WHERE course_code = '$lala' ");
					$checkCouInf = mysqli_num_rows($selCouInf);
					if ($checkCouInf > 0) {
						//update the ID to the new lecturer taking the couse
						$updateLecId = mysqli_query($db_conx, "UPDATE courseInfo SET lecture_Id ='$staffId' WHERE course_code = '$lala' ");
					} else {
						$insertCourseInfo = mysqli_query($db_conx, "INSERT INTO courseInfo(id, course_code, course_title, semester, level, lecture_Id, students_id, dateMade) VALUES(NULL, '$lala', '$courseTitle', '$semester', '$level', '$staffId', '', NOW())");
					}
					if ($insertCourseInfo || $updateLecId) {
						$level = 100;
						++$j;
					}
				} else {
					$j = 1;
					$level += 100;
				}
			}
		}
	}
	
}

//assing to a staff a particular section for guadians and parenting
if (isset($_POST['btn4']) && !empty($_POST['staffId4']) && !empty($_POST['session4']) && !empty($_POST['department4'])) {
	$staffId4 = htmlentities($_POST['staffId4']);
	$session4 = htmlentities($_POST['session4']);
	$faculty4 = htmlentities($_POST['faculty4']);
	$department4 = htmlentities($_POST['department4']);
	//get faculty and depart no for this managing set
	$selF_Dn0 = mysqli_query($db_conx, "SELECT fNo_with_dNo FROM faculties_and_departments_in_norm WHERE faculty='$faculty4' AND department='$department4' ");
	$checkF_Dn0 = mysqli_num_rows($selF_Dn0);
	if ($checkF_Dn0 > 0) {
		while ($row = mysqli_fetch_array($selF_Dn0)) {
			$f_dNo = $row['fNo_with_dNo'];
		}
		//now update the lecturer details to handle this students
		$updaWork = mysqli_query($db_conx, "UPDATE staffsInto_normUni SET managing_set='$session4', fNo_with_dNo='$f_dNo' WHERE staffID='$staffId4' ");
		$updaStuInstruc = mysqli_query($db_conx, "UPDATE studentsIn_normUni SET instructor = '$staffId4' WHERE fNo_with_dNo='$f_dNo'");
		if ($updaWork && $updaStuInstruc) {
			$report .= "<div style='color:green;'>Students Assigned</div>";
		} else {
			$report .= "<div style='color:red;'>Students not Assigned</div>";
		}
	}
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Norm Admins</title>
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/news.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<style type="text/css">
		.ASBText {
		    font-size: 110%;
		    color: #790909e0;
		    margin-bottom: 10px;
		}
		.SSec {
		    padding-top: 15px;
		    border-top: 1px solid gray;
		    margin-top: 15px;
		}
		.Slabel1 {
			display: inline-block;
    		color: #615f5f;
    		width: 9%;
    		font-size: 95%;
		}
		.Slabel {
		    display: inline-block;
    		color: #615f5f;
    		width: 20%;
    		font-size: 95%;
		}
		.ASQInput {
		    border: 1px solid gray;
		    padding: 5px;
    		border-radius: 5px;
		}
		.ASACourse {
		    margin-top: 23px;
    		color: #525252;
		}
		.ASACCour {
		    width: 45%;
		}
		.ACBtn {
		   margin-top: 25px;
		    padding: 8px 10px;
		    color: white;
		    margin-right: 30%;
		    background-color: #585656;
		    border: none;
		    border-radius: 5px;
		    cursor: pointer;
		}
	</style>
</head>
<body>
	<div>
		<?php include_once("navSec.php"); ?>
		<div class="ARCon floatR">
			<div class="NBText01">Staffs</div>
			<div style="margin-bottom: 10px;"><?php echo $report;; ?></div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div>
					<div class="ASBText">Mail a staff</div>
				</div>
				<div class="SSec">
					<div class="ASBText">Assign course to a staff</div>
					<div><span class="Slabel1">Staff ID : </span><span><input type="text" name="staffId" class="ASQInput" placeholder="staff ID"></span></div>
					<div class="ASACourse">
						<div class="floatL ASACCour"><span class="Slabel">Course 1 : </span><span><input type="text" name="course1" placeholder="course code" class="ASQInput"></span></div>
						<div class="floatL ASACCour"><span class="Slabel">Course 2 : </span><span><input type="text" name="course2" placeholder="course code" class="ASQInput"></span></div>
						<div class="clearing"></div>
					</div>
					<div class="ASACourse">
						<div class="floatL ASACCour"><span class="Slabel">Course 3 : </span><span><input type="text" name="course3" placeholder="course code" class="ASQInput"></span></div>
						<div class="floatL ASACCour"><span class="Slabel">Course 4 : </span><span><input type="text" name="course4" placeholder="course code" class="ASQInput"></span></div>
						<div class="clearing"></div>
					</div>
					<div class="ASACourse">
						<div class="floatL ASACCour"><span class="Slabel">Course 5 : </span><span><input type="text" name="course5" placeholder="course code" class="ASQInput"></span></div>
						<div class="floatL ASACCour"><span class="Slabel">Course 6 : </span><span><input type="text" name="course6" placeholder="course code" class="ASQInput"></span></div>
						<div class="clearing"></div>
					</div>
					<div><input type="submit" name="btn2" value="submit" class="ACBtn floatR"></div>
					<div class="clearing"></div>
				</div>
				<div class="SSec">
					<div class="ASBText">Get staff details</div>
				</div>
				<div class="SSec">
					<div class="ASBText">Assign Students Management</div>
					<div>
						<div class="floatL ASACCour">
							<span class="Slabel">Staff ID : </span>
							<span><input type="text" name="staffId4" class="ASQInput" placeholder="staff ID"></span>
						</div>
						<div class="floatL ASACCour">
							<span class="Slabel">Session</span>
							<span><input type="text" name="session4" class="ASQInput" placeholder="entry year of set"></span>
						</div>
						<div class="clearing"></div>
					</div>
					<div class="ASACourse">
						<div  class="floatL ASACCour">
							<span class="Slabel">Faculty</span>
							<span><input type="text" name="faculty4" class="ASQInput" placeholder="faculty"></span>
						</div>
						<div class="floatL ASACCour">
							<span class="Slabel">Department</span>
							<span><input type="text" name="department4" class="ASQInput" placeholder="department"></span>
						</div>
					</div>
					<div class="clearing"></div>
					<div><input type="submit" name="btn4" value="submit" class="ACBtn floatR"></div>
				</div>
			</form>
			</div>
		<div class="clearing"></div>
		</div>
	</div>
</body>
</html>