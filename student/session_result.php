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
			//get session and split into available sessions
			$splitEnSession = explode("/", $entrysession);
			$splitOnSession = explode("/", $onSession);
			//compare the first sessions
			$enSession = (int)$splitEnSession[0];
			$enEndSession = (int)$splitEnSession[1];
			$currSession = (int)$splitOnSession[0];
			$diffSession = $currSession - $enSession;
			$moveSession = "";
			for ($i=0; $i <= $diffSession; $i++) { 
				$moveSession = $enSession;
				if ($moveSession <= $currSession) {
					array_push($session1, $moveSession);
					array_push($session2, $enEndSession);
					$grandsession = $moveSession."/".$enEndSession;
					array_push($availSession, $grandsession);
					$enEndSession += 1;
				}
			}
		}
		if (isset($_POST['submit']) && !empty($_POST['forSession']) && !empty($_POST['forSemester'])) {
			$_SESSION['resuSession'] = htmlentities($_POST['forSession']);
			$_SESSION['resuSemester'] = htmlentities($_POST['forSemester']);
			if ($_SESSION['resuSession'] != "" && $_SESSION['resuSemester'] != "") {
				header("location:view_result.php");
			} else {
				$report .= "<div style='color :red;'>result not found</div>";
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
		.whichCon {
		    margin-bottom: 20px;
		}
		.setYe {
		    display: inline-block;
    		width: 8%;
		}
		.setValue {
		    display: inline-block;
		    width: 9%;
		    border: 2px solid gray;
		    border-radius: 7px;
		}
		.subBtn {
			cursor: pointer;
		}
	</style>
</head>
<body>
	<?php include_once("../include/stuPortal.php"); ?>
		<div class="floatL RSPSSSec">
			<div class="RHSPSec">
				<div class="floatL">Profile >> session</div>
				<div class="floatR">Program : Bachelor of Science in <?php echo $depart; ?></div>
				<div class="clearing"></div>
			</div>
			<div id="MSPFCon">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="whichCon">
					<span class="setYe">Session :</span>
					<select class="setValue" name="forSession">
						<option></option>
						<?php
						for ($j=0; $j < count($availSession); $j++) { 
							echo "<option>$availSession[$j]</option>";
						}
						?>
					</select>
				</div>
				<div class="whichCon">
					<span class="setYe">semester :</span>
					<select class="setValue" name="forSemester">
						<option></option>
						<option>first</option>
						<option>second</option>
					</select>
				</div>
				<div><input type="submit" name="submit" value="submit" class="subBtn"></div>
			</form>
			</div>
		</div>
		<div class="clearing"></div>
</body>
</html>