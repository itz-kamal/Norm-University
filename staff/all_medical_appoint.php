<?php
	session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPass = $_SESSION['password'];

	if ($currentStaID != "" && $currentPass != "") {
		$selectStuData = "SELECT * FROM staffsInto_normUni WHERE staffID = '$currentStaID' AND password = '$currentPass' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectStuData);
		$checkStu = mysqli_num_rows($selectQuery);
		if ($checkStu > 0) {
			while ($row = mysqli_fetch_array($selectQuery)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = strtoupper($row['department']);
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
	<title>medical appointment</title>
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
    		width: 65%;
		}
		.sn {
		    width: 8%;
		    border-right: 1px solid grey;
		    padding: 5px;
		    text-align: center;
		}
		.bigWeight {
		    font-weight: 600;
		}
		.dates {
		    width: 23%;
		    border-right: 1px solid grey;
		    padding: 5px;
		    text-align: center;
		}
	</style>
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Appointments >> all medical appointments</div>
				<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div class="appoinSec">
					<div class="PABText01">All Appointment</div>
					<div class="appCover bigWeight">
						<div class="sn floatL">S/N</div>
						<div class="dates floatL">About</div>
						<div class="dates floatL">Set Date</div>
						<div class="dates floatL">Time</div>
						<div class="dates floatL">Sent Date</div>
						<div class="clearing"></div>
					</div>
					<?php
					$selSentApp = mysqli_query($db_conx, "SELECT * FROM appointment WHERE from_who ='$currentStaID' AND type= 'medical' ");
					$checkSentApp = mysqli_num_rows($selSentApp);
					if ($checkSentApp > 0) {
						$i = 1;
						while ($row =mysqli_fetch_assoc($selSentApp)) {
							$about = $row['appointment'];
							$setDate = $row['authorize_date'];
							$sentDate = $row['date_made'];
							$time = $row['fixed_time'];
							echo "<div class='appCover'>
									<div class='sn floatL'>$i</div>
									<div class='dates floatL'>$about</div>
									<div class='dates floatL'>$setDate</div>
									<div class='dates floatL'>$time</div>
									<div class='dates floatL'>$sentDate</div>
									<div class='clearing'></div>
								</div>";
							++$i;
						}
					}
					?>
				</div>
			</div>
		</div>
		<div class="clearing"></div>
	</div>
</body>
</html>