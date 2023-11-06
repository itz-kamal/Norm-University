<?php
	session_start();
	include_once("../include/connect.php");
	
	if (isset($_POST['submit']) && !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['dateOfBirth']) && !empty($_POST['nationality']) && !empty($_POST['mobile1']) && !empty($_POST['email'])  && !empty($_POST['address1']) && !empty($_POST['faculty']) && !empty($_POST['department']) && !empty($_POST['examType']) && !empty($_POST['examGrade']) && !empty($_POST['study']) && !empty($_FILES['passport']['name']) && !empty($_FILES['passport']['tmp_name']) && !empty($_FILES['passport']['size'])) {
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
		$password = htmlentities(sha1($_POST['lastName']));
		$oldPassword = htmlentities(sha1($_POST['lastName']));
		$address1 = htmlentities($_POST['address1']);
		$address2 = htmlentities($_POST['address2']);
		$faculty = htmlentities($_POST['faculty']);
		$department = htmlentities($_POST['department']);
		$examType = htmlentities($_POST['examType']);
		$examGrade = htmlentities($_POST['examGrade']);
		$gender = htmlentities($_POST['gender']);
		$study = htmlentities($_POST['study']);
		//birth cetificate file
		$BCName = $_FILES['birthCertificate']['name'];
		$BCTmpName = $_FILES['birthCertificate']['tmp_name'];
		$BCSize =$_FILES['birthCertificate']['size'];
		$BCError = $_FILES['birthCertificate']['error'];
		$kaboom1 = explode(".", $BCName);
		$BirthExt = end($kaboom1);
		$level = htmlentities($_POST['level']);
		//passport file
		$PPName = $_FILES['passport']['name'];
		$PPTmpName = $_FILES['passport']['tmp_name'];
		$PPSize = $_FILES['passport']['size'];
		$PPError = $_FILES['passport']['error'];
		$kaboom2 = explode(".", $PPName);
		$PPExt = end($kaboom2);
		//set entry year
		$this_year = date("Y");
		$this_year_sort = date("y");
		$withNext = (int)$this_year_sort + 1;
		$entryYear = $this_year."/".$withNext;

		//select from database
		$selectFEDB = "SELECT matricNo,departNo,faculty,department FROM studentsIn_normUni WHERE faculty = '$faculty' AND department = '$department' LIMIT 1";
		$selectQuery = mysqli_query($db_conx, $selectFEDB);
		$checkDB = mysqli_num_rows($selectQuery);
		if ($checkDB == 0) {
			// select the faculty and department number
			$selectFADNo = "SELECT fNo_with_dNo FROM faculties_and_departments_in_norm WHERE faculty = '$faculty' AND  department = '$department' LIMIT 1";
			$selectFADNQuery = mysqli_query($db_conx, $selectFADNo);
			$checkFADNo = mysqli_num_rows($selectFADNQuery);
			if ($checkFADNo > 0 && $BCError == 0 && $PPError == 0) {
				while ($row = mysqli_fetch_array($selectFADNQuery)) {
					//faculty and department number from database
					$fAndDNumber = $row['fNo_with_dNo'];
					//current year
					$currentYear = date("y");
					$cFAndDNo = "";
					//adding 0 to the faculty and department digit
					if ($fAndDNumber < 1000) {
						$cFAndDNo .= "0".$fAndDNumber;
					} else {
						$cFAndDNo .= $fAndDNumber;
					}
					$studentNo = 1;
					//first student matric number
					$matricNo = $currentYear.$cFAndDNo."00".$studentNo;
					$BCExtCon = $BirthExt == "png" || $BirthExt == "jpeg" || $BirthExt == "jpg";
					$PPExtCon = $PPExt == "png" || $PPExt == "jpeg" || $PPExt == "jpg";
					if ($BCExtCon && $PPExtCon) {
						move_uploaded_file($BCTmpName, "stuBirthCert/$BCName");
						move_uploaded_file($PPTmpName, "stuPassport/$PPName");
						//now insert the student details along with matric number
						$insertData = "INSERT INTO studentsIn_normUni(id,matricNo,fNo_with_dNo,departNo,semester,title,firstName,lastName,middleName,password,oldPassword,dateOfBirth,nationality,maritalStatus,religion,mobile1,mobile2,email,homeAddress1,homeAddress2,faculty,department,examType,examGrade,gender,study,verified,token,birthCertificate,passport, entryYear, level, instructor, onSession, cgpa, date_made) VALUES (NULL,'$matricNo', '$fAndDNumber','1', 'first', '$title', '$firstName', '$lastName', '$middleName', '$password', '$oldPassword', '$dateOfBirth', '$nationality', '$maritalStatus', '$religion', '$mobile1','$mobile2', '$email', '$address1', '$address2', '$faculty', '$department', '$examType', '$examGrade', '$gender', '$study', 'NO', '0', '$BCName', '$PPName', '$entryYear', '100', '0', '2021/22', '0', NOW())";
						$insertQuery = mysqli_query($db_conx, $insertData);
						if ($insertQuery) {
							//pass details into session
							$_SESSION['matricNo'] = $matricNo;
							$_SESSION['lastName'] = $lastName;
							$_SESSION['title'] = $title;
							$_SESSION['firstName'] = $firstName;
							$_SESSION['departName'] = $department;
							header("location:confirmed.php");
							exit();
						} else {
							$report .="<div style='color:red;'>Sign up not successful</div>";
						}
					}
					
				}
			}

		} else {
				// select the faculty and department number
			$selectFADNo = "SELECT fNo_with_dNo FROM faculties_and_departments_in_norm WHERE faculty = '$faculty' AND  department = '$department' LIMIT 1";
			$selectFADNQuery = mysqli_query($db_conx, $selectFADNo);
			$checkFADNo = mysqli_num_rows($selectFADNQuery);
			if ($checkFADNo > 0 && $BCError == 0 && $PPError == 0) {
				while ($row = mysqli_fetch_array($selectFADNQuery)) {
					//faculty and department number from database
					$fAndDNumber = $row['fNo_with_dNo'];
				//select the last student in that department to for your matricNo
				$selectLSIMD = "SELECT matricNo,departNo FROM studentsIn_normUni WHERE faculty = '$faculty' AND department = '$department' ORDER BY id DESC LIMIT 1";
				$SLSIMDQuery = mysqli_query($db_conx, $selectLSIMD);
				$checkLSIMD = mysqli_num_rows($SLSIMDQuery);
				if ($checkLSIMD > 0) {
					while ($row = mysqli_fetch_array($SLSIMDQuery)) {
						//the student and matric number pass them to a variable
						$LSIMDSNo = $row['departNo'];
						$LSIMDMatNo = $row['matricNo'];
						//increase those number before inserting
						$NextSIMDSNo = $LSIMDSNo+1;
						$NextSIMDMatNo = $LSIMDMatNo+1;
						$nextSMatNo =$NextSIMDMatNo;
						$BCExtCon = $BirthExt == "png" || $BirthExt == "jpeg" || $BirthExt == "jpg";
						$PPExtCon = $PPExt == "png" || $PPExt == "jpeg" || $PPExt == "jpg";
						if ($BCExtCon && $PPExtCon) {
							//move the student files
							move_uploaded_file($BCTmpName, "stuBirthCert/$BCName");
							move_uploaded_file($PPTmpName, "stuPassport/$PPName");
							//other students
							$insertData = "INSERT INTO studentsIn_normUni(id,matricNo,fNo_with_dNo,departNo,semester,title,firstName,lastName,middleName,password,oldPassword,dateOfBirth,nationality,maritalStatus,religion,mobile1,mobile2,email,homeAddress1,homeAddress2,faculty,department,examType,examGrade,gender,study,verified,token,birthCertificate,passport, entryYear, level, instructor, onSession, cgpa, date_made) VALUES (NULL,'$nextSMatNo', '$fAndDNumber','$NextSIMDSNo', 'first', '$title', '$firstName', '$lastName', '$middleName', '$password', '$oldPassword', '$dateOfBirth', '$nationality', '$maritalStatus', '$religion', '$mobile1','$mobile2', '$email', '$address1', '$address2', '$faculty', '$department', '$examType', '$examGrade', '$gender', '$study', 'NO', '0', '$BCName', '$PPName', '$entryYear', '100', '0', '2021/22', '0', NOW())";
							$insertQuery = mysqli_query($db_conx, $insertData);
							if ($insertQuery) {
								//pass details into session
								$_SESSION['matricNo'] = $nextSMatNo;
								$_SESSION['lastName'] = $lastName;
								$_SESSION['title'] = $title;
								$_SESSION['firstName'] = $firstName;
								$_SESSION['departName'] = $department;
								header("location:confirmed.php");
								exit();
							}else {
								$report .="<div style='color:red;'>Sign up not successful</div>";
							}
						} else {
							$report .="div style='color:red;'>file format not supported</div>";
						}
					}
				}
				}
				
			} else {
				$report .="div style='color:red;'>file error</div>";
			}
		}
	} else {}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Norm new students application</title>
	<link rel="stylesheet" type="text/css" href="../css/admission.css">
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="../css/studentSU.css">
</head>
<body>
	<div class="THTop">
		<div class="SLink floatL"><a href="index.php" class="ILink">Norm University</a></div>
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
		<div style="margin-bottom: 15px;"><?php echo $report;?></div>
		<div class="TOApp">Personal Information<i class="fas fa-info-circle circleFont"></i></div>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Title</span>
					<select class="TQInput" name="title" >
						<option>--Title--</option>
						<option value="Mr">Mr</option>
						<option value="Mrs">Mrs</option>
						<option value="Miss">Miss</option>
					</select>
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Last Name <span class="requiredData">**</span></span>
					<input type="text" name="lastName" class="TQInput" >
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">First Name <span class="requiredData">**</span></span>
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
					<span class="QHead">Date of Birth <span class="requiredData">**</span></span>
					<input type="date" name="dateOfBirth" class="TQInput" >
				</div>
				<div class="floatL RSAQuery">
					<span class="QHead">Nationality <span class="requiredData">**</span></span>
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
					<span class="QHead">Mobile Number 2 <span class="requiredData">**</span></span>
					<input type="text" name="mobile2" class="NQInput">
				</div>
				<div class="clearing"></div>
			</div>
			<div class="BQCDiv">
				<div class="floatL LSAQuery">
					<span class="QHead">Email <span class="requiredData">**</span></span>
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
					<span class="QHead">Home Adress 1 <span class="requiredData">**</span></span>
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
				<div class="floatR RSAQuery">
					<span class="QHead">Passport <span class="requiredData">**</span></span>
					<input type="file" name="passport">
				</div>
				<div class="clearing"></div>
			</div>
			<div>
				<div class="TOApp">Norm Application<i class="fas fa-info-circle circleFont"></i></div>
				<div class="BQCDiv">
					<div class="floatL LSAQuery">
						<span class="QHead">Faculty <span class="requiredData">**</span></span>
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
						<span class="QHead">Department <span class="requiredData">**</span></span>
						<input type="text" name="department" class="TQInput">
					</div>
					<div class="clearing"></div>
				</div>
				<div class="BQCDiv">
					<div class="floatL LSAQuery">
						<span class="QHead">Examination Type <span class="requiredData">**</span></span>
						<select class="TQInput" name="examType" >
							<option>--Test--</option>
							<option value="TOFEL">TOFEL</option>
							<option value="GMAT">GMAT</option>
							<option value="JAMB">JAMB</option>
							<option value="SAT">SAT</option>
							<option value="JUPEB">JUPEB</option>
							<option value="IELTS">IELTS</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Examination Grade <span class="requiredData">**</span></span>
						<input type="text" name="examGrade" class="TQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div class="BQCDiv">
					<div class="floatL LSAQuery">
						<span class="QHead">Gender</span>
						<select class="TQInput" name="gender" >
							<option>--Gender--</option>
							<option value="male">MALE</option>
							<option value="female">FEMALE</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">study</span>
						<select class="TQInput" name="study" >
							<option>--Study--</option>
							<option value="undergraduate">Undergraduate</option>
							<option value="graduate">Graduate</option>
							<option value="JAMB">business education</option>
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