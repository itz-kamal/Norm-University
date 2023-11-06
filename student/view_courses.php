<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStuMatNo = $_SESSION['matricNo'];
	$currentStuPas = $_SESSION['password'];

	if ($currentStuMatNo != "" && $currentStuPas != "") {
		$level = "";
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
				$level = $row['level'];
				$semester = $row['semester'];
				$fNo_and_dno = $row['fNo_with_dNo'];

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
			<div class="floatL">Courses >> Course registration</div>
			<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<table>
				<tr>
					<th>S/N</th>
					<th>course code</th>
					<th>course title</th>
					<th>units</th>
					<th>status</th>
				</tr>
				<?php 
				//show all registered courses by this student
				$SRCourses = mysqli_query($db_conx, "SELECT * FROM courseReg WHERE matricNo='$currentStuMatNo'");
				$CFMCourses = mysqli_num_rows($SRCourses);
				if ($CFMCourses > 0) {
					while ($row = mysqli_fetch_array($SRCourses)) {
						$MCCodes = $row['course_code'];
						$MCTitles = $row['course_title'];
						$MCUnits = $row['units'];
						$MCStatus = $row['status'];
					}
					$EMCCodes = explode(",", $MCCodes);
					$EMCTitles = explode(",", $MCTitles);
					$EMCUnits = explode(",", $MCUnits);
					$EMCStatus = explode(",", $MCStatus);
					$j = 1;
					for ($i=0; ($i < count($EMCCodes) ) && $j < count($EMCCodes); ++$i) { 
						echo "<tr>
							<td>$j</td>
							<td>$EMCCodes[$i]</td>
							<td>$EMCTitles[$i]</td>
							<td>$EMCUnits[$i]</td>
							<td>$EMCStatus[$i]</td>
							</tr>";
						++$j;
					}
				}
				?>
			</table>
			<div><div class="print">Print</div></div>
		</div>
	</div>
</body>
</html>