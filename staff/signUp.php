<?php
session_start();
	include_once("../include/connect.php");
	
	if (isset($_POST['submit']) && !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['dateOfBirth']) && !empty($_POST['nationality']) && !empty($_POST['mobile1']) && !empty($_POST['mobile2']) && !empty($_POST['email'])  && !empty($_POST['address1']) && !empty($_POST['faculty']) && !empty($_POST['department']) && !empty($_POST['yearsOE']) && !empty($_POST['degree']) && !empty($_FILES['passport']['name']) && !empty($_FILES['passport']['tmp_name']) && !empty($_FILES['passport']['size'])) {

		// if all values are set pass them into a variable
		$title = htmlentities($_POST['title']);
		$lastName = htmlentities($_POST['lastName']);
		$firstName = htmlentities($_POST['firstName']);
		$middleName = htmlentities($_POST['middleName']);
		$dateOfBirth = htmlentities($_POST['dateOfBirth']);
		$nationality = htmlentities($_POST['nationality']);
		$maritalStatus = htmlentities($_POST['maritalStatus']);
		$religion = htmlentities($_POST['religion']);
		$mobile1 = htmlentities($_POST['mobile1']);
		$mobile2 = htmlentities($_POST['mobile2']);
		$email = htmlentities($_POST['email']);
		$address1 = htmlentities($_POST['address1']);
		$address2 = htmlentities($_POST['address2']);
		$faculty = htmlentities($_POST['faculty']);
		$department = htmlentities($_POST['department']);
		$yearsOE = htmlentities($_POST['yearsOE']);
		$password = htmlentities(sha1($_POST['lastName']));
		$gender = htmlentities($_POST['gender']);
		// passport file contents
		$PPName = htmlentities($_FILES['passport']['name']);
		$PPTmpName = htmlentities($_FILES['passport']['tmp_name']);
		$PPSize = htmlentities($_FILES['passport']['size']);
		$PPError = htmlentities($_FILES['passport']['error']);
		$kaboom1 = explode(".", $PPName);
		$PPFExt = end($kaboom1);
		$degree = htmlentities($_POST['degree']);
		$course1 = htmlentities($_POST['course1']);
		$course2 = htmlentities($_POST['course2']);
		// birth certificate file
		$BCName = htmlentities($_FILES['birthCertificate']['name']);
		$BCTmpName = htmlentities($_FILES['birthCertificate']['tmp_name']);
		$BCSize = htmlentities($_FILES['birthCertificate']['size']);
		$BCError = htmlentities($_FILES['birthCertificate']['error']);
		$kaboom2 = explode(".", $BCName);
		$BCFExt = end($kaboom2);
		$report = "";
		
		// selecting from data base for last user in my department
		$selectQuery01 = mysqli_query($db_conx, "SELECT staffID,staffNO,faculty,department FROM staffsInto_normUni WHERE faculty = '$faculty' AND department = '$department' LIMIT 1");
		$checkDB = mysqli_num_rows($selectQuery01);
		if ($checkDB == 0) {
			//select the faculty and department number
			$selectQuery02 = mysqli_query($db_conx, "SELECT fNo_with_dNo FROM faculties_and_departments_in_norm WHERE faculty = '$faculty' AND  department = '$department' LIMIT 1");
			$checkFAD = mysqli_num_rows($selectQuery02);
			if ($checkFAD > 0 && $BCError == 0 && $PPError == 0) {
				while ($row = mysqli_fetch_array($selectQuery02)) {
					//faculty and department number from database
					$fAndDNumber = $row['fNo_with_dNo'];
					$staffNo = 1;
					$staffID = $fAndDNumber."00".$staffNo;
					$BCExtCon = $BCFExt == "png" || $BCFExt == "jpeg" || $BCFExt == "jpg";
					$PPExtCon = $PPFExt == "png" || $PPFExt == "jpeg" || $PPFExt == "jpg";
					if ($BCExtCon && $PPExtCon) {
						//move files
						move_uploaded_file($PPTmpName, "birthC_passP/$PPName");
						move_uploaded_file($BCTmpName, "birthC_passP/$BCName");
						//insert new staff
						echo  $staffID;
						$insertQuery = mysqli_query($db_conx, "INSERT INTO staffsInto_normUni(id,staffID,password,title,firstName,lastName,middleName,dateOfBirth,nationality,maritalStatus,religion,mobile1,mobile2,email,homeAddress1,homeAddress2,faculty,department,yearsOE,degree,gender,passport,course1,course2,verified,token,birthCertificate, managing_set, fNo_with_dNo, semester, onSession, date_made) VALUES (NULL, $staffID, '$password', '$title', '$firstName', '$lastName', '$middleName', '$dateOfBirth', '$nationality', '$maritalStatus', '$religion', '$mobile1','$mobile2', '$email', '$address1', '$address2', '$faculty', '$department', '$yearsOE', '$degree', '$gender', '$PPName', '$course1', '$course2', 'NO', '0', '$BCName', '', '0', 'first', '2021/22', NOW())");
						if ($insertQuery) {
							//pass details into session
							$_SESSION['staffID'] = $staffID;
							$_SESSION['lastName'] = $lastName;
							$_SESSION['title'] = $title;
							$_SESSION['firstName'] = $firstName;
							$_SESSION['departName'] = $department;
							header("location:confirmation.php");
							exit();
						} else {
							$report .="<div style='color:red;'>Sign up not successful</div>";
						}
					} else {
						$report .="<div style='color:red;'>file format not supported</div>";
					}
				}
			} else {
				$report .="<div style='color:red;'>file error</div>";
			}
		} else {
			//increase the staff id for the next lecturer
			if ($PPError == 0 && $BCError == 0) {
				$selectLSQ = mysqli_query($db_conx, "SELECT staffID,staffNO FROM staffsInto_normUni WHERE faculty = '$faculty' AND department = '$department' ORDER BY id DESC LIMIT 1");
				$checkLS = mysqli_num_rows($selectLSQ);
				//check user file upload
				$BCExtCon = $BCFExt == "png" || $BCFExt == "jpeg" || $BCFExt == "jpg";
				$PPExtCon = $PPFExt == "png" || $PPFExt == "jpeg" || $PPFExt == "jpg";
				if ($checkLS > 0 && $BCExtCon && $PPExtCon) {
					while ($row = mysqli_fetch_array($selectLSQ)) {
						move_uploaded_file($PPTmpName, "birthC_passP/$PPName");
						move_uploaded_file($BCTmpName, "birthC_passP/$BCName");
						//get the last staff ID and Number
						$LSId = $row['staffID'];
						$LSNo = $row['staffNo'];
						// set the next staff ID and Number
						$NSId = $LSId + 1;
						$NSNo = $LSNo + 1;
						$insertQuery = mysqli_query($db_conx, "INSERT INTO staffsInto_normUni(id,staffID,password,title,firstName,lastName,middleName,dateOfBirth,nationality,maritalStatus,religion,mobile1,mobile2,email,homeAddress1,homeAddress2,faculty,department,yearsOE,degree,gender,passport,course1,course2,verified,token,birthCertificate, managing_set, fNo_with_dNo, semester, onSession, date_made) VALUES (NULL, $NSId, '$password', '$title', '$firstName', '$lastName', '$middleName', '$dateOfBirth', '$nationality', '$maritalStatus', '$religion', '$mobile1','$mobile2', '$email', '$address1', '$address2', '$faculty', '$department', '$yearsOE', '$degree', '$gender', '$PPName', '$course1', '$course2', 'NO', '0', '$BCName','', '0', 'first', '2021/22', NOW())");
						if ($insertQuery) {
							//pass details into session
							$_SESSION['staffID'] = $NSId;
							$_SESSION['lastName'] = $lastName;
							$_SESSION['title'] = $title;
							$_SESSION['firstName'] = $firstName;
							$_SESSION['departName'] = $department;
							header("location:confirmation.php");
							exit();
						} else {
							$report .="<div style='color:red;'>Sign up not successful</div>";
						}
					}
				}
			}
		}
	} else {}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Norm new staff application</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/admission.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="../css/studentSU.css">
</head>
<body>
	<!--application poratl for staffs-->
	<div class="THTop">
		<div class="SLink floatL"><a href="../index.php" class="ILink">Norm University</a></div>
		<div class="NavLink floatR">
			<a href="studentPage.php" class="MNLink">Students</a>
			<a href="f_sPage.php" class="MNLink">Faculty & staff</a>
			<a href="familyPage.php" class="MNLink">Families</a>
			<a href="visitors.php" class="MNLink">visitors</a>
			<a href="donate.php" class="MNLink">Donate</a>
			<span><i class="fas fa-search searchFont"></i></span>
		</div>
		<div class="clearing"></div>
	</div>
	<div class="APPText">Application into Norm</div>
	<div id="FSSApp">
		<div style="margin-bottom: 20px;"><?php echo $report;?></div>
		<div class="TOApp">Personal Information<i class="fas fa-info-circle circleFont"></i></div>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Title</span>
					<select class="TQInput" name="title" >
						<option>--Title--</option>
						<option value="MR">MR</option>
						<option value="MRS">MRS</option>
						<option value="MISS">MISS</option>
					</select>
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Last Name  <span class="requiredData">**</span></span>
					<input type="text" name="lastName" class="TQInput" >
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">First Name  <span class="requiredData">**</span></span>
					<input type="text" name="firstName" class="TQInput" >
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Middle Name</span>
					<input type="text" name="middleName" class="TQInput" >
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Date of Birth  <span class="requiredData">**</span></span>
					<input type="date" name="dateOfBirth" class="TQInput" >
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Nationality  <span class="requiredData">**</span></span>
					<input type="text" name="nationality" class="TQInput" >
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Marital Status</span>
					<select class="TQInput" name="maritalStatus" >
						<option>--Status--</option>
						<option value="single">Single</option>
						<option value="married">Married</option>
						<option value="divorced">Divorced</option>
						<option value="widow">Widow</option>
					</select>
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Religion</span>
					<input type="text" name="religion" class="TQInput" >
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Mobile Number 1 <span class="requiredData">**</span></span>
					<input type="text" name="mobile1" class="NQInput" id="NIMNo" >
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Mobile Number 2  <span class="requiredData">**</span></span>
					<input type="text" name="mobile2" class="NQInput">
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Email  <span class="requiredData">**</span></span>
					<input type="text" name="email" class="TQInput" >
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Comfirm Email</span>
					<input type="text" name="" class="TQInput">
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Home Adress 1  <span class="requiredData">**</span></span>
					<input type="text" name="address1" class="TQInput" >
				</div>	
				<div class="floatL RSAQuery">
					<span class="QHead">Birth Certificate</span>
					<input type="file" name="birthCertificate">
				</div>
				<div class="clearing"></div>
			</div>	
			<div class="BQCDiv">	
				<div class="floatL LSAQuery">
					<span class="QHead">Home Adress 2</span>
					<input type="text" name="address2" class="TQInput" >
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Spouse Name</span>
					<input type="text" name="spouseName" class="TQInput">
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Gender</span>
					<select class="TQInput" name="gender">
						<option>--gender--</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Passport  <span class="requiredData">**</span></span>
					<input type="file" name="passport">
				</div>
				<div class="clearing"></div>
			</div>
			<div>
				<div class="TOApp">Norm Application<i class="fas fa-info-circle circleFont"></i></div>
				<div class="BQCDiv">
					<div class="floatL LSAQuery">
						<span class="QHead">Faculty  <span class="requiredData">**</span></span>
						<select type="text" name="faculty" class="TQInput">
							<option>--faculties--</option>
							<option value="arts">arts</option>
							<option value="basic medical science">basic medical science</option>
							<option value="business administration">business administration</option>
							<option value="clinical and dental science">clinical and dental science</option>
							<option value="engineering">engineering</option>
							<option value="environmental science">environmental science</option>
							<option value="law">law</option>
							<option value="pharmacy">pharmacy</option>
							<option value="science">science</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Department  <span class="requiredData">**</span></span>
						<input type="text" name="department" class="TQInput">
					</div>
					<div class="clearing"></div>
				</div>
				<div class="BQCDiv">
					<div class="floatL LSAQuery">
						<span class="QHead">Years of Experience  <span class="requiredData">**</span></span>
						<input type="text" name="yearsOE" class="TQInput">
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Highest Degree  <span class="requiredData">**</span></span>
						<select class="TQInput" name="degree">
							<option>--degree-</option>
							<option value="ND">ND</option>
							<option value="HND">HND</option>
							<option value="BSC">BSC</option>
							<option value="BTech">BTech</option>
							<option value="Masters">Masters</option>
							<option value="PHD">PHD</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div class="BQCDiv">
					<div class="floatL LSAQuery">
						<span class="QHead">Course 1</span>
						<select class="TQInput" name="course1" >
							<option>--courses--</option>
							<option value="TOFEL">TOFEL</option>
							<option value="GMAT">GMAT</option>
							<option value="JAMB">JAMB</option>
							<option value="SAT">SAT</option>
							<option value="JUPEB">JUPEB</option>
							<option value="IELTS">IELTS</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Course 2</span>
						<select class="TQInput" name="course2" >
							<option>--courses--</option>
							<option value="TOFEL">TOFEL</option>
							<option value="GMAT">GMAT</option>
							<option value="JAMB">JAMB</option>
							<option value="SAT">SAT</option>
							<option value="JUPEB">JUPEB</option>
							<option value="IELTS">IELTS</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
			</div>
			<div class="BTNdiv">
				<input type="submit" name="submit" value="SUBMIT" class="MFBtn" id="TNBtn">
			</div>
			<div class="clearing"></div>
		</form>
</body>
<script type="text/javascript" src="js/studentSU.js"></script>
</html>