<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStuMatNo = $_SESSION['matricNo'];
	$currentStuPas = $_SESSION['password'];
	$resSession = $_SESSION['resuSession'];
	$resSemester = $_SESSION['resuSemester'];

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
		
	} else {
		header("location:signIn.php");
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
		table {
			border-collapse: collapse;
		}
		th, td {
			border: 1px solid black;
			padding: 10px;
			text-align: center;
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
		.print {
		    letter-spacing: 1.3px;
    		font-size: 80%;
		    padding: 10px;
		    background-color: #3a1919d4;
		    width: 6%;
		    text-align: center;
		    color: white;
		    border-radius: 5px;
		    margin-top: 35px;
		}
	</style>
</head>
<body>
	<?php include_once("../include/stuPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Profile >> result</div>
				<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<table>
				<tr>
					<th>S/N</th>
					<th>course code</th>
					<th>course title</th>
					<th>C/A</th>
					<th>Exam</th>
					<th>Total</th>
					<th>Grade</th>
				</tr>
				<?php 
				//show all registered courses by this student
				if (!empty($resSession) && !empty($resSemester)) {
					$SRCourses = mysqli_query($db_conx, "SELECT * FROM student_result WHERE matricNo='$currentStuMatNo' AND session= '$resSession' AND semester= '$resSemester'");
					$CFMCourses = mysqli_num_rows($SRCourses);
					if ($CFMCourses > 0) {
						while ($row = mysqli_fetch_array($SRCourses)) {
							$MCCodes = $row['course_codes'];
							$MCTitles = $row['course_title'];
							$MCCa = $row['caScore'];
							$MCExam = $row['examScore'];
							$MCTotal = $row['total'];
							$MCGrade = $row['grade'];
							$MSaSGp = $row['gpa'];
						}
						//split all
						$splitCodes = explode(",", $MCCodes);
						$splitTitles = explode(",", $MCTitles);
						$splitCa = explode(",", $MCCa);
						$splitExam = explode(",", $MCExam);
						$splitTotal = explode(",", $MCTotal);
						$splitGrade = explode(",", $MCGrade);
						$j = 1;
						for ($i=0; $i < count($splitCodes)-1; ++$i) { 
							echo "<tr>
									<td>$j</td>
									<td>$splitCodes[$i]</td>
									<td>$splitTitles[$i]</td>
									<td>$splitCa[$i]</td>
									<td>$splitExam[$i]</td>
									<td>$splitTotal[$i]</td>
									<td>$splitGrade[$i]</td>
								</tr>";
							++$j;
						}
					} else {
						$report .= "<div style='color: red;'>result not found</div>";
					}
				}
				?>
				</table>
				<div style="margin-top: 15px;">Semester GPA : <span style="color: darkred; margin-left: 10px;"><?php echo $MSaSGp; ?></span>
				</div>
				<div style="margin-top: 15px;"><?php echo $report; ?></div>
			</div>
		</div>
		<div class="clearing"></div>
</body>
</html>