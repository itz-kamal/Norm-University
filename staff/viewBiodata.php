<?php
session_start();
	include_once("../include/connect.php");
	//identify the current student

	$currentStaID = $_SESSION['staffID'];
	$currentPas = $_SESSION['password'];

	if ($currentStaID != "" && $currentPas != "") {
		$selectStaData = mysqli_query($db_conx, "SELECT firstReg.*, comReg.* FROM staffsInto_normUni AS firstReg INNER JOIN other_reg AS comReg ON firstReg.staffID = $currentStaID AND comReg.matricNo = $currentStaID LIMIT 1");
		$checkData = mysqli_num_rows($selectStaData);
		if ($checkData > 0) {
			while ($row = mysqli_fetch_assoc($selectStaData)) {
				$lastName = $row['lastName'];
				$firstName = $row['firstName'];
				$depart = $row['department'];
				$PPName = $row['passport'];
				$staffID = $row['staffID'];
				$title = $row['title'];
				$dOB = $row['dateOfBirth'];
				$middleName = $row['middleName'];
				$nationality = $row['nationality'];
				$address = $row['homeAddress1'];
				$mobile = $row['mobile1'];
				$email = $row['email'];
				$program = $row['study'];
				//other reg
				$stateOfOrigin = $row['stateOfOrigin'];
				$localGovt = $row['localGov'];
				$kin = $row['nextOfKin'];
				$kinAddress = $row['addressKin'];
				$sponsorMobile = $row['sponsorMobile'];
				$sponsor = $row['sponsor'];
				
			}
		} else {
			header("location:registration.php");
		}
	//input new details such as maidens name and the rest
	} else {
		header("location:signIn.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Biodata</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentPortal.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="../css/mobilePortal.css">
	<style type="text/css">
		.UPCon {
			position: relative;
		    margin: 15px 0;
		}
		.UPLabel {
		    display: inline-block;
    		width: 35%;
		}
		.UPANot {
			display: inline-block;
			width: 30%;
    		color: gray;
		}
		.UPAble {
		    width: 80%;
		    padding: 5px;
   			border: 2px solid gray;
		}
		.TALab {
			position: absolute;
			top: 0;
			width: 35%;
		}
		textarea {
			margin-left: 36%;
   			border: 2px solid gray;
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
	<?php include_once("../include/staffPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Profile >> View biodata</div>
				<div class="floatR">Department : <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
				<div class="UPCon">
					<span class="UPLabel">Staff Number :</span>
					<span class="UPANot"><?php echo $staffID; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Title :</span>
					<span class="UPANot"><?php echo $title; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Surname :</span>
					<span class="UPANot"><?php echo $lastName; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">First Name :</span>
					<span class="UPANot"><?php echo $firstName; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Middle Name :</span>
					<span class="UPANot"><?php echo $middleName; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Date of Birth :</span>
					<span class="UPANot"><?php echo $dOB; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Nationality :</span>
					<span class="UPANot"><?php echo $nationality; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">State of Origin :</span>
					<span class="UPANot"><?php echo $stateOfOrigin; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Local Government :</span>
					<span class="UPANot"><?php echo $localGovt; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Permanent Home Address :</span>
					<span class="UPANot"><?php echo $address; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Telephone Number :</span>
					<span class="UPANot"><?php echo $mobile; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Email Address :</span>
					<span class="UPANot"><?php echo $email; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Department :</span>
					<span class="UPANot"><?php echo $depart; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Next of Kin :</span>
					<span class="UPANot"><?php echo $kin; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Address of Next of Kin :</span>
					<span class="UPANot"><?php echo $kinAddress; ?></span>
				</div>
				<div class="UPCon">
					<span class="UPLabel">Sibling Telephone Number :</span>
					<span class="UPANot"><?php echo $sponsorMobile; ?></span>
				</div>
			<div><div class="print">Print</div></div>
			</div>
		</div>
		<div class="clearing"></div>
</body>
</html>