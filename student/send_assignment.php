
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
				$semester = $row['semester'];
				$level = $row['level'];
			}
		}
		//get all the courses i am doing
		$SMCourses = mysqli_query($db_conx, "SELECT course_code, course_title FROM courseReg WHERE matricNo='$currentStuMatNo' AND level='$level' OR (matricNo='$currentStuMatNo' AND semester='$semester') ");
		$CMCurCourses = mysqli_num_rows($SMCourses);
		if ($CMCurCourses > 0) {
			while ($row = mysqli_fetch_array($SMCourses)) {
				$course_code = $row['course_code'];
				$course_title = $row['course_title'];
			}
			$CCodes = explode(",", $course_code);
			$CTitles = explode(",", $course_title);
		}
	} else {
		header("location:studentSI.php");
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
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		.eachAss {
		    border: 1px solid #5d5c5c;
    		width: 80%;
		}
		.weight {
			font-weight: 700;
		}
		.assCode {
		    display: inline-block;
		    width: 11%;
		    border-right: 1px solid black;
		    padding: 8px;
		}
		.assTop {
		    padding: 8px;
		    display: inline-block;
		    width: 38%;
		    border-right: 1px solid black;
		}
		.assCon {
		    display: inline-block;
    		width: 10%;
    		text-align: center;
		}
		.assPage {
		    text-align: center;
		    width: 100%;
		    background-color: gray;
		    color: white;
		    padding: 7px;
		    font-size: 85%;
		    border-radius: 5px;
		    cursor: pointer;
		}
	</style>
</head>
<body>
	<?php include_once("../include/stuPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Assignments</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div class="eachAss">
				<span class="assCode weight">Code</span>
				<span class="assTop weight">Course Title</span>
				<span class="assTop weight">Assignment Topic</span>
			</div>
			<?php
			for ($i=0; $i < count($CCodes); $i++) { 
				$TCCode = $CCodes[$i];
				$TCTitle = $CTitles[$i];
				$SAss4MCourse = mysqli_query($db_conx, "SELECT * FROM staff_assign WHERE course_code='$TCCode' ");
				$checkCor = mysqli_num_rows($SAss4MCourse);
				if ($checkCor > 0) {
					while ($row = mysqli_fetch_array($SAss4MCourse)) {
						$TCTopic = $row['topic'];
						$MCCode = $row['course_code'];
						$id = $row['id'];
						echo "<div class='eachAss'>
							<span class='assCode'>$TCCode</span>
							<span class='assTop'>$TCTitle</span>
							<span class='assTop'>$TCTopic</span>
							<span class='assCon'><a href='my_answer.php?n=$id' class='assPage'>answer</a></span>
						</div>";
					}
				}
			}
			?>
			
		</div>
	</div>
</body>
</html>