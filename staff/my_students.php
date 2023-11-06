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
		.allCon {
		    width: 70%;
    		border: 1px solid gray;
		}
		.tableRoll {
			border-bottom: 1px solid grey;
		}
		.numbers {
		    width: 11%;
		    padding: 5px;
		    text-align: center;
		}
		.stuNum {
		    border-left: 1px solid gray;
		    border-right: 1px solid gray;
		    width: 25%;
		    padding: 5px;
		    text-align: center;
		}
		.stuName {
		    border-right: 1px solid gray;
		    padding: 5px;
		    text-align: center;
		    width: 50%;
		}
		.bigWeight {
			font-weight: 700;
		}
	</style>
</head>
<body>
	<?php include_once("../include/staffPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Profile >> my students</div>
				<div class="floatR">Department : <?php echo strtoupper($depart); ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div class="allCon">
					<div class="tableRoll">
						<div class="numbers floatL bigWeight">S/N</div>
						<div class="stuNum floatL bigWeight">Student No</div>
						<div class="stuName floatL bigWeight">Name</div>
						<div class="numbers floatL bigWeight">CGPA</div>
						<div class="clearing"></div>
					</div>
					<?php
					//show all my students
					$selMyStuInfo = mysqli_query($db_conx, "SELECT matricNo, firstName, lastName, cgpa FROM studentsIn_normUni WHERE instructor = '$currentStaID' ");
					$checkMyInfo = mysqli_num_rows($selMyStuInfo);
					if ($checkMyInfo > 0) {
						$i = 1;
						while ($row = mysqli_fetch_assoc($selMyStuInfo)) {
							$matricNo = $row['matricNo'];
							$stuFirstName = strtoupper($row['firstName']);
							$stuLastName = strtoupper($row['lastName']);
							$cgpa = $row['cgpa'];
							echo "<div class='tableRoll'>
									<div class='numbers floatL'>$i</div>
									<div class='stuNum floatL'>$matricNo</div>
									<div class='stuName floatL'>$stuFirstName $stuLastName</div>
									<div class='numbers floatL'>$cgpa</div>
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
</body>
</html>