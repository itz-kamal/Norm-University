
<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStuMatNo = $_SESSION['matricNo'];
	$currentStuPas = $_SESSION['password'];
	if ($currentStuMatNo != "" && $currentStuPas != "") {
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
				$semester = $row['semester'];
				$level = $row['level'];
			}
		}
		$CAnsId = $_GET['n'];
		//details of this question
		$SCQuestion = mysqli_query($db_conx, "SELECT * FROM staff_assign WHERE id='$CAnsId' ");
		$checkQuestion = mysqli_num_rows($SCQuestion);
		if ($checkQuestion > 0) {
			while ($row = mysqli_fetch_array($SCQuestion)) {
				$topic = $row['topic'];
				$question = $row['query'];
				$formAnswer = $row['answer'];
				$formStudent = $row['students'];
				$formDate = $row['submit_time'];
			}
		}
		//input answers
		if (isset($_POST['submit']) && !empty($_POST['answers'])) {
			$answer = htmlentities($_POST['answers']);
			$allAnswer = $formAnswer.$answer."[{//}]";
			$alStudents = $formStudent.$currentStuMatNo.",";
			$subTime = $formDate.date('d-m-y h:i:s').",";
			$UpAnswer = mysqli_query($db_conx, "UPDATE staff_assign SET students='$alStudents', answer='$allAnswer', submit_time='$subTime' WHERE id='$CAnsId' LIMIT 1 ");
			if ($UpAnswer) {
				$report .="<div style='color:green;'>Answer submitted</div>";
			} else {
				$report .="<div style='color:red;'>Answer not submitted</div>";
			}
		}
			
	} else {
		header("location:studentSI.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My answer</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		.labelTag {
		    display: inline-block;
    		width: 10%;
		}
		.QMarToBotm {
		    margin-top: 10px;
    		margin-bottom: 10px;
		}
		.answer {
		    width: 58%;
		    height: 290px;
		    margin-bottom: 28px;
		    resize: none;
		}
		.BtnWidth {
		    width: 58%;
		}
		.sendAns {
		    float: right;
		    padding: 9px;
		    color: white;
		    background-color: #7d7c7c;
		    border: none;
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
			<div style="margin-bottom: 10px;"><?php echo $report; ?></div>
			<div>
				<span class="labelTag">Topic : </span>
				<span><?php echo $topic;; ?></span>
			</div>
			<div class="QMarToBotm">
				<span class="labelTag">Question : </span>
				<span><?php echo $question;; ?></span>
			</div>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>?n=<?php echo $CAnsId;?>" method="POST">
				<div>
					<textarea class="answer" name="answers"></textarea>
					<div class="BtnWidth"><input type="submit" name="submit" class="sendAns"></div>
				</div>
			</form>
			<?php

			?>
		</div>
	</div>
</body>
</html>