<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentStuaPas = $_SESSION['password'];
	if ($currentStaID != "" && $currentStuaPas != "") {
		$assId = $_GET['n'];
		$question = $_SESSION['query'];
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
		.bigWeight {
		    font-weight: 600;
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
			width: 42%;
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
		.quesSec {
			margin-bottom: 20px;
		}
		.theQues {
		    margin-left: 10px;
		    font-size: 120%;
		    color: green;
		}
	</style>
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
	<div class="floatL RSPSSSec">
		<div class="RHSPSec">
			<div class="floatL">Assignments >> answers</div>
			<div class="floatR">Department : <?php echo $depart; ?></div>
			<div class="clearing"></div>
		</div>
		<div id="MSPFCon">
			<div class="quesSec">
				<span>Question :</span>
				<span class="theQues"><?php echo $question;?></span>
			</div>
			<div class="appoinSec">
				<div class="appCover bigWeight">
					<div class="sn2 floatL">S/N</div>
					<div class="bigWidth4 floatL">Student No</div>
					<div class="bigWidth5 floatL">Answer</div>
					<div class="dates floatL">Date</div>
					<div class="dates floatL">Time</div>
					<div class="dates floatL">Grade</div>
					<div class="clearing"></div>
				</div>
			<?php
			$selAss = mysqli_query($db_conx, "SELECT * FROM staff_assign WHERE id= '$assId'");
			$checkAss = mysqli_num_rows($selAss);
			if ($checkAss > 0) {
				while ($row = mysqli_fetch_array($selAss)) {
					$allStudents = $row['students'];
					$allAnswers = $row['answer'];
					$allTime = $row['submit_time'];
					//split all
					$splitStu = explode(",", $allStudents);
					$splitAns = explode("[{//}]", $allAnswers);
					$splitTime = explode(",", $allTime);
					$k = 1;
					for ($i=0; $i < count($splitStu)-1 ; $i++) { 
						//split time and date
						$splitTaD = explode(" ", $splitTime[$i]);
						echo "<div class='appCover'>
								<div class='sn2 floatL'>$k</div>
								<div class='bigWidth4 floatL'>$splitStu[$i]</div>
								<div class='bigWidth5 floatL'>$splitAns[$i]</div>
								<div class='dates floatL'>$splitTaD[0]</div>
								<div class='dates floatL'>$splitTaD[1]</div>
								<div class='dates floatL'>0.00</div>
								<div class='clearing'></div>
							</div>";
						++$k;
					}
				}
			}
			?>
			</div>
		</div>
	</div>
</body>
</html>