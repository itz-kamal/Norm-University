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
			$insertQuery = mysqli_query($db_conx, "INSERT INTO staff_assign(id, lecture_id, course_code, topic, query, students, answer, score, submit_time, onSession, onSemester, dateMade) VALUES(NULL, '$currentStaID', '$course', '$topic', '$question', '', '', '', '', '$goinSession', '$goinSemester', NOW())");
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
		.CCodesCon {
		    margin-bottom: 2%;
		}
		.tag {
		    margin-bottom: 6px;
    		margin-top: 20px;
		}
		.CCodes {
		    margin-left: 2%;
    		width: 10%;
 		    background-color: #eeeeee;
 		    padding: 2px;
 		    border-radius: 4px;
		}
		.topicLabel {
		    width: 8%;
		}
		.topicCon {
		    margin-left: 7px;
    		outline: none;
    		width: 46%;
		}
		.topic {
	        margin: 0px;
		    width: 94%;
		    height: 30px;
		    resize: none;
		    font-size: 113%;
		    font-family: sans-serif;
		}
		.questionCon {
		    margin-left: 8px;
    		width: 50%;
		}
		.question {
		    width: 100%;
		    height: 62px;
		    resize: none;
		    font-size: 125%;
		    font-family: sans-serif;
		}
		.lilMessage {
		    font-size: 80%;
		    color: #7d7c7c;
		    margin-bottom: 13px;
		}
		.btn1 {
		    padding: 8px 12px;
		    background-color: #6d6c6c;
		    color: white;
		    border: none;
		    border-radius: 5px;
		    cursor: pointer;
		}
	</style>
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Assignments >> set Assignment</div>
			<div class="floatR">Department : <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div style="margin-top: 10px; margin-bottom: 10px;"><?php echo $report;?></div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="CCodesCon">
					<span class="courseTag">Course : </span>
					<select name="CCodes" class="CCodes">
						<?php
						//show lecture courses
						$selectCourseInfo =mysqli_query($db_conx, "SELECT * FROM courseInfo WHERE lecture_Id = '$currentStaID'");
						$checkCourseInfo = mysqli_num_rows($selectCourseInfo);
						if ($checkCourseInfo > 0) {
							$i = 1;
							while ($row = mysqli_fetch_array($selectCourseInfo)) {
								$course_code = $row['course_code'];
								//create loop for course names
								$courseName = "course".$i;
								echo "<option value='$course_code'>$course_code</option>";
								++$i;
							}
						}
						?>
						
					</select>
				</div>
				<div>
					<div class="topicLabel floatL"> Topic : </div><div class="topicCon floatL"><textarea name="topic" class="topic"></textarea></div>
					<div class="clearing"></div>
				</div>
				<div class="tag">
					<div class="topicLabel floatL">Question : </div>
					<div class="questionCon floatL"><textarea class="question" name="question"></textarea></div>
					<div class="clearing"></div>
				</div>
				<div class="lilMessage">Send assignment to all students</div>
				<div><input type="submit" name="submit" value="Send" class="btn1"></div>
			</form>
		</div>
	</div>
</body>
</html>