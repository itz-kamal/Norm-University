<?php
session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPas = $_SESSION['password'];
	if ($currentStaID != "" && $currentPas != "") {
		$selectStaData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentPas' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectStaData);
		$checkSta = mysqli_num_rows($selectQuery);
		if ($checkSta > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = $row['department'];
				$PPName = $row['passport'];
				$onSession = $row['onSession'];
			}
		}
		//get this student current semester Result
		if (isset($_POST['checkBtn']) && !empty($_POST['stuNoInput'])) {
			$theStudent = htmlentities($_POST['stuNoInput']);
		//arrays to store result details
			$storeCouCodes = array();
			$storeTitles = array();
			$storeUnits = array();
			$storeCa = array();
			$storeExam = array();
			$storeTotal = array();
			$storeGrade = array();
			//student details
			$selStuDetails = mysqli_query($db_conx, "SELECT firstName, lastName, middleName, semester, onSession FROM studentsIn_normUni WHERE matricNo ='$theStudent' AND instructor ='$currentStaID' LIMIT 1 ");
			$checkStuDetails = mysqli_num_rows($selStuDetails);
			if ($checkStuDetails > 0) {
				while ($row = mysqli_fetch_array($selStuDetails)) {
					$theStuFirstName = $row['firstName'];
					$theStuLastName = strtoupper($row['lastName']);
					$theStuMidtName = $row['middleName'];
					$theCurrSession = $row['onSession'];
					$theCurrSemester = $row['semester'];
				}
			}
			//get all registered courses by this student
			$SRCourses = mysqli_query($db_conx, "SELECT * FROM courseReg WHERE matricNo = '$theStudent' AND the_session = '$onSession' LIMIT 1");
			$CFMCourses = mysqli_num_rows($SRCourses);
			if ($CFMCourses > 0) {
				while ($row = mysqli_fetch_array($SRCourses)) {
					$allCouCodes = $row['course_code'];
					$course_title = $row['course_title'];
					$units = $row['units'];
				}
			//split course then get result
				$splitCode = explode(",", $allCouCodes);
				$splitTitle = explode(",", $course_title);
				$splitUnit = explode(",", $units);
			//select each course result for this student
				for ($i=0; $i < count($splitCode); $i++) { 
					$selDisCouReslt = mysqli_query($db_conx, "SELECT * FROM course_result WHERE course_code ='$splitCode[$i]' AND the_session ='$onSession' ");
					$checkDisStuRe = mysqli_num_rows($selDisCouReslt);
					if ($checkDisStuRe > 0) {
						//saving up course codes
						array_push($storeCouCodes, $splitCode[$i]);
						array_push($storeTitles, $splitTitle[$i]);
						array_push($storeUnits, $splitUnit[$i]);
						while ($row = mysqli_fetch_array($selDisCouReslt)) {
							$allStuIds = $row['student_ids'];
							$allCas = $row['ca'];
							$allExams = $row['exam'];
							$allTotals = $row['total'];
							$allGrades = $row['grade'];
						}
						$splitStuIds = explode(",", $allStuIds);
						$splitCa = explode(",", $allCas);
						$splitExam = explode(",", $allExams);
						$splitTotal = explode(",", $allTotals);
						$splitGrade = explode(",", $allGrades);
					//get the student result for each course code
						for ($j=0; $j < count($splitStuIds); $j++) { 
							if ($splitStuIds[$j] == $theStudent) {
							//each student score for the correct student
								array_push($storeCa, $splitCa[$j]);
								array_push($storeExam, $splitExam[$j]);
								array_push($storeTotal, $splitTotal[$j]);
								array_push($storeGrade, $splitGrade[$j]);
							}						
						}
					}
				}
			}
		}
		//save student result
		if (isset($_POST['submitBtn']) && !empty($_POST['disSemgpa'])) {
			$sn = $_POST['lastSn'];
			$prefix = "result";
			$resCodes = "";
			$resTitles = "";
			$resunit = "";
			$resCa = "";
			$resExam = "";
			$resTotal = "";
			$resGrade = "";
			$resGpa = $_POST['disSemgpa'];
			$theStudent = htmlentities($_POST['ownerStuNo']);
			$theCurrSession = htmlentities($_POST['ownerSession']);
			$theCurrSemester = htmlentities($_POST['ownerSemester']);
			for ($m=0; $m < $sn; ++$m) {
				//accumulating course codes
				$codeId = $prefix."".$m;
				$codeName = htmlentities($_POST[$codeId]);
				$resCodes .= $codeName.",";
				// accuumulating course titles
				$titleId = $prefix."".$m."".$m;
				$TitleName = htmlentities($_POST[$titleId]);
				$resTitles .= $TitleName.",";
				//accumulating units
				$unitId = $prefix."".$m."".$m."".$m;
				$unitName = htmlentities($_POST[$unitId]);
				$resunit .= $unitName.",";
				//accumulating CAs
				$caId = $prefix."".$m."".$m."".$m."".$m;
				$caName = htmlentities($_POST[$caId]);
				$resCa .= $caName.",";
				//accumulating exam scores
				$examId = $prefix."".$m."".$m."".$m."".$m."".$m;
				$examName = htmlentities($_POST[$examId]);
				$resExam .= $examName.",";
				//accumulating total scores
				$totalId = $prefix."".$m."".$m."".$m."".$m."".$m."".$m;
				$totalName = htmlentities($_POST[$totalId]);
				$resTotal .= $totalName.",";
				//accumulating grades
				$gradeId = $prefix."".$m."".$m."".$m."".$m."".$m."".$m."".$m;
				$gradeName = htmlentities($_POST[$gradeId]);
				$resGrade .= $gradeName.",";
			}
			//save this student current session result
			$insertResult = mysqli_query($db_conx, "INSERT INTO student_result(id, staffID, matricNo, course_codes, course_title, course_unit, caScore, examScore, total, grade, session, semester, gpa, cgpa, date_made) VALUES(NULL, '$currentStaID', '$theStudent', '$resCodes', '$resTitles', '$resunit', '$resCa', '$resExam', '$resTotal', '$resGrade', '$theCurrSession', '$theCurrSemester', '$resGpa', '0', NOW())");
			if ($insertResult) {
				$report .= "<div style='color: green;'>result sent</div>";
			} else {
				$report .= "<div style='color: red;'>result not sent</div>";
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
	<title>staff dashboard</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		.bigBr {
			border : 1px solid grey;
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
		    width: 10%;
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
		.getDetailsCon {
		    padding: 10px 0 15px;
		    border-bottom: 1px solid darkred;
		    margin-bottom: 15px;
		}
		.getMatNo {
		    padding: 3px 5px;
		    border: 1.5px solid gray;
		    border-radius: 4px;
		    cursor: pointer;
		}
		.matNoCon {
		    display: inline-block;
		    width: 10%;
		    padding: 2px;
		    margin-left: 15px;
		    border: 2px solid gray;
		    border-radius: 5px;
		}
		.getAction {
		    display: inline-block;
    		margin-left: 50px;
		}
		.deatils1 {
		    margin-left: 15px;
		    width: 30%;
		    font-weight: 200;
		    display: inline-block;
		}
		.deatils3 {
			margin-left: 15px;
		    width: 70%;
		    font-weight: 200;
		    display: inline-block;
		}
		.detailsL2 {
		    width: 50%;
		}
		.showdetails {
		    margin: 15px 0;
		}
		.hideInput {
		    width: 100%;
		    border: none;
		    outline: none;
		    text-align: center;
		    cursor: default;
		}
		.gpBtn {
		    display: inline-block;
		    width: 6%;
		    background-color: #2e3a5ab5;
		    color: white;
		    padding: 5px;
		    font-size: 90%;
		    border-radius: 5px;
		    text-align: center;
		    cursor: pointer;
		    margin-right: 50px;
		}
	</style>
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Profile</div>
				<div class="floatR">Department : <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div style="margin-bottom: 20px;"><?php echo $report; ?></div>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="getDetailsCon">
						<span>Student Number : </span>
						<select class="matNoCon" name="stuNoInput">
							<?php
							$selMyStus = mysqli_query($db_conx, "SELECT matricNo FROM studentsIn_normUni WHERE instructor = '$currentStaID'");
							$checDisStu = mysqli_num_rows($selMyStus);
							if ($checDisStu > 0) {
								while ($row = mysqli_fetch_array($selMyStus)) {
									$stuNumber = $row['matricNo'];
									echo "<option>$stuNumber</option>";
								}
							}
							?>
						</select>
						<span class="getAction"><input type="submit" name="checkBtn" value="check" class="getMatNo"></span>
					</div>
					<div>
						<div class="showdetails">
							<div class="floatL detailsL2">Name : <span class="deatils3"><?php echo "$theStuLastName $theStuFirstName $theStuMidtName"; ?></span></div>
							<div class="floatL">Student No : <span class="deatils1"><input type="text" class='hideInput' name="ownerStuNo" value="<?php echo $theStudent; ?>"/></span></div>
							<div class="clearing"></div>
						</div>
						<div class="showdetails">
							<div class="floatL detailsL2">session : <span class="deatils1"><input type="text" class='hideInput' name="ownerSession" value="<?php echo $theCurrSession; ?>"/></span></div>
							<div class="floatL">semester : <span class="deatils1"><input type="text" class='hideInput' name="ownerSemester" value="<?php echo $theCurrSemester; ?>"/></span></div>
							<div class="clearing"></div>
						</div>
						<div class="bigBr">
							<div class="forBBline">
								<div class="iterateText headFont">S/N</div>
								<div class="conText headFont">Code</div>
								<div class="conText2 headFont">Course title</div>
								<div class="conText headFont">Unit</div>
								<div class="conText headFont">C/A score</div>
								<div class="conText headFont">Exam score</div>
								<div class="conText headFont">Total</div>
								<div class="conText headFont">Grade</div>
							</div>
						<?php
						//for iteration
						$l = 1;
						$myResult = "result";
						for ($k=0; $k < count($storeTotal); $k++) { 
							echo "<div class='forBBline'>
									<div class='iterateText'><input name='lastSn'  class='hideInput' value='$l'/></div>
									<div class='conText'><input class='hideInput' name='$myResult$k' value='$storeCouCodes[$k]'/></div>
									<div class='conText2'><input class='hideInput' name='$myResult$k$k' value='$storeTitles[$k]'/></div>
									<div class='conText'><input class='hideInput' name='$myResult$k$k$k' id='$myResult$k$k' value='$storeUnits[$k]'/></div>
									<div class='conText'><input class='hideInput' name='$myResult$k$k$k$k' value='$storeCa[$k]'/></div>
									<div class='conText'><input class='hideInput' name='$myResult$k$k$k$k$k' value='$storeExam[$k]'/></div>
									<div class='conText'><input class='hideInput' name='$myResult$k$k$k$k$k$k' value='$storeTotal[$k]'/></div>
									<div class='conText'><input class='hideInput' name='$myResult$k$k$k$k$k$k$k' id='$myResult$k' value='$storeGrade[$k]'/></div>
								</div>";
							++$l;
						}
						?>
						</div>
						<div id="hiddenVal" style='visibility: hidden;'><?php echo $k;?></div>
					</div>
					<div class="showdetails">
						<div class="detailsL2">GPA : <input class='hideInput' style="color: darkred;" name='disSemgpa' id="gpa" value=''/></div>
					</div>
					<div class="showdetails">
						<span class="gpBtn floatL" onclick="runPoint()">run GP</span>
						<span><input type="submit" name="submitBtn" class=" floatL"></span>
						<span class="clearing"></span>
					</div>
				</form>
			</div>
		</div>
		<div class="clearing"></div>
<script src="../js/thisStaff.js"></script>
</body>
</html>