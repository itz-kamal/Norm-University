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
			//storage for availabe sesiion results
			$availSession = array();
			$session1 = array();
			$session2 = array();
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = $row['department'];
				$PPName = $row['passport'];
				$entrysession = $row['entryYear'];
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
	<title>student dashboard</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		.appSec {
		    border: 1px solid black;
    		width: 75%;
		}
		.bigWeight {
			font-weight: 600;
		}
		.sn {
		    padding: 5px;
		    border-right: 1px solid black;
		    width: 6%;
		    text-align: center;
		}
		.lectu {
		    padding: 5px;
		    border-right: 1px solid black;
		    width: 32%;
		    text-align: center;
		}
		.dates {
		    padding: 5px;
		    border-right: 1px solid black;
		    width: 15%;
		    text-align: center;
		}
	</style>
</head>
<body>
	<?php include_once("../include/stuPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Profile >> my appointments</div>
				<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div class="appSec bigWeight">
					<div class="sn floatL">S/N</div>
					<div class="lectu floatL">lecturer</div>
					<div class="lectu floatL">Appointment</div>
					<div class="dates floatL">Set Date</div>
					<div class="dates floatL">Set Time</div>
					<div class="clearing"></div>
				</div>
				<?php
				$selApp = mysqli_query($db_conx, "SELECT * FROM appointment WHERE from_who= '$currentStuMatNo' AND type= 'lecture'");
				$checkApp = mysqli_num_rows($selApp);
				if ($checkApp > 0) {
					$i = 1;
					while ($row = mysqli_fetch_array($selApp)) {
						$lecture = $row['lecturer'];
						$appoint = $row['appointment'];
						$date = $row['preferred_date'];
						$time = $row['fixed_time'];
						//get lecturer names 
						$selLect = mysqli_query($db_conx, "SELECT title, firstName, lastName FROM staffsInto_normUni WHERE staffID = '$lecture'");
						$checkLect = mysqli_num_rows($selLect);
						if ($checkLect > 0) {
							while ($row = mysqli_fetch_array($selLect)) {
								$lectTitle = $row['title'];
								$lectFName = $row['firstName'];
								$lectLName = $row['lastName'];
							}
						}
						echo "<div class='appSec'>
								<div class='sn floatL'>$i</div>
								<div class='lectu floatL'>$lectTitle $lectLName $lectFName</div>
								<div class='lectu floatL'>$appoint</div>
								<div class='dates floatL'>$date</div>
								<div class='dates floatL'>$time</div>
								<div class='clearing'></div>
							</div>";
						++$i;
					}
				}
				?>
			</div>
		</div>
		<div class="clearing"></div>
</body>
</html>