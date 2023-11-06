<?php
 $this_year = date("Y");
 $this_year_sort = date("y");
 $withNext = (int)$this_year_sort + 1;
 echo $this_year."<br/>".$withNext;
 /* for cgpa
//work on the cgpa
			$selPastGrades = mysqli_query($db_conx, "SELECT grade, course_unit FROM student_result WHERE matricNo= '$theStudent'");
			$checkPastRes = mysqli_num_rows($selPastGrades);
			if ($checkPastRes > 0) {
				$ovarallPoint = 0;
				$overallUnit = 0;
				while ($row = mysqli_fetch_array($selPastGrades)) {
					$setGrade = $row['grade'];
					$setUnits = $row['course_unit'];
					//split grades and units
					$eachGrades = explode(",", $setGrade);
					$eachUnit = explode(",", $setUnits);
					for ($n=0; $n < count($eachGrades); $n++) { 
						$overallUnit += (int)$eachUnit[$n];
						if ($eachGrades[$n] == "A") {
							$pointee = 5 * $eachUnit[$n];
							$ovarallPoint += (int)$pointee;
						} else if ($eachGrades[$n] == "B") {
							$pointee = 4 * $eachUnit[$n];
							$ovarallPoint += (int)$pointee;
						} else if ($eachGrades[$n] == "C") {
							$pointee = 3 * $eachUnit[$n];
							$ovarallPoint += (int)$pointee;
						} else if ($eachGrades[$n] == "D") {
							$pointee = 2 * $eachUnit[$n];
							$ovarallPoint += (int)$pointee;
						} else if ($eachGrades[$n] == "E") {
							$pointee = 1 * $eachUnit[$n];
							$ovarallPoint += (int)$pointee;
						} else if ($eachGrades[$n] == "F") {
							$pointee = 0 * $eachUnit[$n];
							$ovarallPoint += (int)$pointee;
						} else {
							$pointee = 0;
							$ovarallPoint += (int)$pointee;
						}
					}
				}
			}
 */
/*
// from student sign up
// select the faculty and department number
			$selectFADNo = "SELECT fNo_with_dNo FROM faculties_and_departments_in_norm WHERE faculty = '$faculty' AND  department = '$department' LIMIT 1";
			$selectFADNQuery = mysqli_query($db_conx, $selectFADNo);
			$checkFADNo = mysqli_num_rows($selectFADNQuery);
$checkFADNo > 0 && 		
				while ($row = mysqli_fetch_array($selectFADNQuery)) {}
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

*/

/*

'$title','$firstName','$lastName','$middleName','$nationality','$maritalStatus','$religion','$mobile1','$mobile2','$email','$address1','$address2','$faculty','$department','$examType','$examGrade',NOW(),'','','$gender','$birthCertificate'

			<div class="TOApp">Origin Information<i class="fas fa-info-circle circleFont"></i></div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">State Of Origin</span>
						<input type="text" name="stateOfOrigin" class="TQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Local Goverment</span>
						<input type="text" name="localGovt" class="TQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Place of Birth</span>
						<input type="text" name="placeOfBirth" class="TQInput">
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Prove of Origin</span>
						<input type="file" name="originCertified" class="FQInput" >
					</div>
					<div class="clearing"></div>
				</div>
			<div class="BTNdiv">
				<button class="TBBtn">Previous</button>
				<div class="TFBtn" id="FPSUDetail" onclick="showNext1()">Next</div>
			</div>
			<div class="clearing"></div>
			</div>


			<div id="SSUinput">
			<div class="TOApp">Parent & Guardian Information<i class="fas fa-info-circle circleFont"></i></div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Father's Name</span>
						<input type="text" name="fathersName" class="TQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Mother's Name</span>
						<input type="text" name="mothersName" class="TQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Father's Mobile</span>
						<input type="text" name="fatherMobile" class="NQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Mother's Mobile</span>
						<input type="text" name="motherMobile" class="NQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Guardian / Sponsor</span>
						<input type="text" name="guardian" class="TQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Guardian Mobile</span>
						<input type="text" name="guardianMobile" class="NQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Next of Kin</span>
						<input type="text" name="nextOfKin" class="TQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Address of Next of Kin</span>
						<input type="text" name="nextOfKinAddress" class="TQInput" >
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Next of Kin's Mobile</span>
						<input type="text" name="nextOfKinMobile" class="NQInput" >
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Sponsor Mobile</span>
						<input type="text" name="sponsorMobile" class="NQInput" >
					</div>
					<div class="clearing"></div>
				</div>
			<div class="TOApp">Medical Information<i class="fas fa-info-circle circleFont"></i></div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Health Status</span>
						<select class="TQInput" name="healthStatus" >
							<option value="healty">Healty</option>
							<option value="fine">Fine</option>
							<option value="bad">Bad</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Specific Disability</span>
						<select class="TQInput" name="disability" >
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Medication Required</span>
						<select class="TQInput" name="medications">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Have you ever been Hospitalized</span>
						<select class="TQInput" name="hospitalization">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Illness for Hospitalization 1</span>
						<select class="TQInput" name="illness1">
							<option value="abnormalHeartBeat">Abnormal Heart Beat</option>
							<option value="abnormalNippleDischarge">Abnormal Nipple Discharge</option>
							<option value="abnormalVaginalBleeding">Abnormal Vaginal Bleeding</option>
							<option value="allergy">Allergy</option>
							<option value="anxietyDisorder">Anxiety Disorder</option>
							<option value="arthritis">Arthritis</option>
							<option value="asthma">Asthma</option>
							<option value="covid_19">COVID-19</option>
							<option value="drugAddiction">Drug Addiction</option>
							<option value="epilepsy">Epilepsy</option>
							<option value="faintingAttacks">Fainting Attacks</option>
							<option value="fracture">FRACTURE</option>
							<option value="hepatitis">Hepatitis</option>
							<option value="highBloodCholestrol">High Blood Cholestrol</option>
							<option value="hypertension">Hypertension</option>
							<option value="malaria">Malaria</option>
							<option value="meningitis">Meningitis</option>
							<option value="depression">Mental Illness / Depression</option>
							<option value="pneumonia">Pneumonia</option>
							<option value="rapeVictim">Rape Victim</option>
							<option value="recurrentMigrane">Recurrent Migrane</option>
							<option value="sickleCell">Sickle Cell Disease</option>
							<option value="STD">STD</option>
							<option value="surgery">Surgery</option>
							<option value="tuberculosis">Tuberculosis</option>
							<option value="typoid">Typhoid</option>
							<option value="prepicUlcer">Prepic Ulcer Disease</option>
							<option value="ulterineFibriods">Ulterine Fibriods</option>
							<option value="others">Others</option>
							<option value="none">None</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Illness for Hospitalization 2</span>
						<select class="TQInput" name="illness2">
							<option value="abnormalHeartBeat">Abnormal Heart Beat</option>
							<option value="abnormalNippleDischarge">Abnormal Nipple Discharge</option>
							<option value="abnormalVaginalBleeding">Abnormal Vaginal Bleeding</option>
							<option value="allergy">Allergy</option>
							<option value="anxietyDisorder">Anxiety Disorder</option>
							<option value="arthritis">Arthritis</option>
							<option value="asthma">Asthma</option>
							<option value="covid_19">COVID-19</option>
							<option value="drugAddiction">Drug Addiction</option>
							<option value="epilepsy">Epilepsy</option>
							<option value="faintingAttacks">Fainting Attacks</option>
							<option value="fracture">FRACTURE</option>
							<option value="hepatitis">Hepatitis</option>
							<option value="highBloodCholestrol">High Blood Cholestrol</option>
							<option value="hypertension">Hypertension</option>
							<option value="malaria">Malaria</option>
							<option value="meningitis">Meningitis</option>
							<option value="depression">Mental Illness / Depression</option>
							<option value="pneumonia">Pneumonia</option>
							<option value="rapeVictim">Rape Victim</option>
							<option value="recurrentMigrane">Recurrent Migrane</option>
							<option value="sickleCell">Sickle Cell Disease</option>
							<option value="STD">STD</option>
							<option value="surgery">Surgery</option>
							<option value="tuberculosis">Tuberculosis</option>
							<option value="typoid">Typhoid</option>
							<option value="prepicUlcer">Prepic Ulcer Disease</option>
							<option value="ulterineFibriods">Ulterine Fibriods</option>
							<option value="others">Others</option>
							<option value="none">None</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Medical Conditions you have Now / Before 1</span>
						<select class="TQInput" name="medicCondition1">
							<option value="abnormalHeartBeat">Abnormal Heart Beat</option>
							<option value="abnormalNippleDischarge">Abnormal Nipple Discharge</option>
							<option value="abnormalVaginalBleeding">Abnormal Vaginal Bleeding</option>
							<option value="allergy">Allergy</option>
							<option value="anxietyDisorder">Anxiety Disorder</option>
							<option value="arthritis">Arthritis</option>
							<option value="asthma">Asthma</option>
							<option value="covid_19">COVID-19</option>
							<option value="drugAddiction">Drug Addiction</option>
							<option value="epilepsy">Epilepsy</option>
							<option value="faintingAttacks">Fainting Attacks</option>
							<option value="fracture">FRACTURE</option>
							<option value="hepatitis">Hepatitis</option>
							<option value="highBloodCholestrol">High Blood Cholestrol</option>
							<option value="hypertension">Hypertension</option>
							<option value="malaria">Malaria</option>
							<option value="meningitis">Meningitis</option>
							<option value="depression">Mental Illness / Depression</option>
							<option value="pneumonia">Pneumonia</option>
							<option value="rapeVictim">Rape Victim</option>
							<option value="recurrentMigrane">Recurrent Migrane</option>
							<option value="sickleCell">Sickle Cell Disease</option>
							<option value="STD">STD</option>
							<option value="surgery">Surgery</option>
							<option value="tuberculosis">Tuberculosis</option>
							<option value="typoid">Typhoid</option>
							<option value="prepicUlcer">Prepic Ulcer Disease</option>
							<option value="ulterineFibriods">Ulterine Fibriods</option>
							<option value="others">Others</option>
							<option value="none">None</option>

						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Medical Conditions you have Now / Before 2</span>
						<select class="TQInput" name="medicCondition2">
							<option value="abnormalHeartBeat">Abnormal Heart Beat</option>
							<option value="abnormalNippleDischarge">Abnormal Nipple Discharge</option>
							<option value="abnormalVaginalBleeding">Abnormal Vaginal Bleeding</option>
							<option value="allergy">Allergy</option>
							<option value="anxietyDisorder">Anxiety Disorder</option>
							<option value="arthritis">Arthritis</option>
							<option value="asthma">Asthma</option>
							<option value="covid_19">COVID-19</option>
							<option value="drugAddiction">Drug Addiction</option>
							<option value="epilepsy">Epilepsy</option>
							<option value="faintingAttacks">Fainting Attacks</option>
							<option value="fracture">FRACTURE</option>
							<option value="hepatitis">Hepatitis</option>
							<option value="highBloodCholestrol">High Blood Cholestrol</option>
							<option value="hypertension">Hypertension</option>
							<option value="malaria">Malaria</option>
							<option value="meningitis">Meningitis</option>
							<option value="depression">Mental Illness / Depression</option>
							<option value="pneumonia">Pneumonia</option>
							<option value="rapeVictim">Rape Victim</option>
							<option value="recurrentMigrane">Recurrent Migrane</option>
							<option value="sickleCell">Sickle Cell Disease</option>
							<option value="STD">STD</option>
							<option value="surgery">Surgery</option>
							<option value="tuberculosis">Tuberculosis</option>
							<option value="typoid">Typhoid</option>
							<option value="prepicUlcer">Prepic Ulcer Disease</option>
							<option value="ulterineFibriods">Ulterine Fibriods</option>
							<option value="others">Others</option>
							<option value="none">None</option>

						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Do you Smoke?</span>
						<select class="TQInput" name="smoker">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Do you take Alcohol?</span>
						<select class="TQInput" name="alcohols">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Any Family History of Hypertension</span>
						<select class="TQInput" name="hypertension">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Any Family History of Epilepsy</span>
						<select class="TQInput" name="epilepsy">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
				<div>
					<div class="floatL LSAQuery">
						<span class="QHead">Any Family History of Mental illness</span>
						<select class="TQInput" name="mentalIllness">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="floatL RSAQuery">
						<span class="QHead">Any Family History of Breast Cancer</span>
						<select class="TQInput" name="breastCancer">
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
					<div class="clearing"></div>
				</div>
			<div class="BTNdiv">
				<div class="MBBtn MFBtn" id="SPBtn" onclick="showPrevious1()">Previous</div>
				<div class="MFBtn" id="SNBtn" onclick="showNext2()">Next</div>
			</div>
			<div class="clearing"></div>
		</div>


		<div id="LSUinput">
			<div id="PSContainer">
				<div class="TOApp">Previous School Information<i class="fas fa-info-circle circleFont"></i></div>
					<div>
						<div class="floatL LSAQuery">
							<span class="QHead">Name of School</span>
							<input type="text" name="nameOfPreSchool" class="TQInput">
						</div>
						<div class="floatL RSAQuery">
							<span class="QHead">Type of School</span>
							<input type="text" name="typeOfPreSchool" class="TQInput">
						</div>
						<div class="clearing"></div>
					</div>
					<div>
						<div class="floatL LSAQuery">
							<span class="QHead">School Address</span>
							<input type="text" name="preSchoolAddress" class="TQInput">
						</div>
						<div class="floatL RSAQuery">
							<span class="QHead">Qualification Obtained</span>
							<input type="text" name="qualification" class="TQInput">
						</div>
						<div class="clearing"></div>
					</div>
					<div>
						<div class="floatL LSAQuery">
							<span class="QHead">Grade</span>
							<input type="text" name="grade" class="TQInput">
						</div>
						<div class="floatL RSAQuery">
							<span class="QHead">Testimonia</span>
							<input type="file" name="testimonia">
						</div>
						<div class="clearing"></div>
					</div>
					<div>
						<div class="floatL LSAQuery">
							<span class="QHead">Fom Date</span>
							<input type="text" name="preStateDate" class="TQInput">
						</div>
						<div class="floatL RSAQuery">
							<span class="QHead">To Date</span>
							<input type="text" name="preEndDate" class="TQInput">
						</div>
						<div class="clearing"></div>
					</div>
			</div>
			<div id="NUASec">
				<div class="ANSSec" onclick="addSchool()">ADD +</div>
				<div class="clearing"></div>
			</div>
			<div class="MFBtn MBBtn" id="TPBtn" onclick="showPrevious2()">Previous</div>



			<div class="BQCDiv">
					<div class="floatL LSAQuery">
						<span class="QHead">Course 1</span>
						<select class="TQInput" name="examType" >
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
						<select class="TQInput" name="examType" >
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
				<div class="BQCDiv">
					<div class="floatL LSAQuery">
						<span class="QHead">Course 3</span>
						<select class="TQInput" name="examType" >
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
						<span class="QHead">Course 4</span>
						<select class="TQInput" name="examType" >
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


//signup to generate matric number before inserting
<?php
	session_start();
	$db_conx = mysqli_connect("localhost","root","root","normUni");

	if (isset($_POST['submit']) && !empty($_POST['title']) && !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['middleName']) && !empty($_POST['dateOfBirth'])&& !empty($_POST['nationality']) && !empty($_POST['maritalStatus']) && !empty($_POST['religion']) && !empty($_POST['mobile1']) && !empty($_POST['mobile2']) && !empty($_POST['email'])  && !empty($_POST['address1']) && !empty($_POST['address2']) && !empty($_POST['faculty']) && !empty($_POST['department']) && !empty($_POST['examType']) && !empty($_POST['examGrade']) && !empty($_POST['gender']) && !empty($_POST['study']) && !empty($_POST['birthCertificate']) && !empty($_POST['level'])) {


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
		$address1 = htmlentities($_POST['address1']);
		$address2 = htmlentities($_POST['address2']);
		$faculty = htmlentities($_POST['faculty']);
		$department = htmlentities($_POST['department']);
		$examType = htmlentities($_POST['examType']);
		$examGrade = htmlentities($_POST['examGrade']);
		$gender = htmlentities($_POST['gender']);
		$study = htmlentities($_POST['study']);
		$birthCertificate = htmlentities($_POST['birthCertificate']);
		$level = htmlentities($_POST['level']);
		$report = "";
		//generate a matriculation number for this individual
		$selectInfo = "SELECT fNo_with_dNo FROM faculties_and_departments_in_norm WHERE faculty = '$faculty' AND  department = '$department' LIMIT 1";
		$infoQuery = mysqli_query($db_conx, $selectInfo);
		$checkInfo = mysqli_num_rows($infoQuery);
		if ($checkInfo > 0) {
			while ($row = mysqli_fetch_array($infoQuery)) {
				//faculty and department number from database
				$fAndDNumber = $row['fNo_with_dNo'];
				//getting current year
				$currentYear = date("y");
				$cFAndDNo = "";
				//adding 0 to the faculty and department digit
				if ($fAndDNumber < 1000) {
					$cFAndDNo .= "0".$fAndDNumber;
				} else {
					$cFAndDNo .= $fAndDNumber;
				}
				$selectISNo = "SELECT * FROM studentsIn_normUni WHERE faculty = '$faculty' AND  department = '$department' ORDER BY id DESC LIMIT 1";
				$queryISNo = mysqli_query($db_conx, $selectISNo);
				$checkISNo = mysqli_num_rows($queryISNo);
				if ($checkISNo > 0) {
					while ($row = mysqli_fetch_array($queryISNo)) {
						$departNo = $row['departNo'];
						//adding zeros to department numbers
						if ($departNo < 9) {
							$departNo = "00".$departNo+1;
						} else if ($departNo >=10 && $departNo < 99) {
							$departNo = "0".$departNo+1;
						} else {
							$departNo = $departNo+1;
						}
						//the matriculation number
						$matriculationNumber = $currentYear.$cFAndDNo.$departNo;
			//insering into the data base
		$insertData = "INSERT INTO studentsIn_normUni(id,matricNo,departNo,title,firstName,lastName,middleName,password,dateOfBirth,nationality,maritalStatus,religion,mobile1,mobile2,email,homeAddress1,homeAddress2,faculty,department,examType,examGrade,gender,study,verified,token,birthCertificate,level,date_made) VALUES (NULL,'$matriculationNumber','$departNo', '$title', '$firstName', '$lastName', '$middleName', '$password', '$dateOfBirth', '$nationality', '$maritalStatus', '$religion', '$mobile1','$mobile2', '$email', '$address1', '$address2', '$faculty', '$department', '$examType', '$examGrade', '$gender', '$study', 'NO', '0', '$birthCertificate', '$level', NOW())";
		$insertQuery = mysqli_query($db_conx, $insertData);
		if ($insertQuery) {
			//selecting the faculty and department digit from a diffrent table to form a matriculation number for the new student
						
				//hold the matric and lastname
				$_SESSION['matricNo'] = $matriculationNumber;
				$_SESSION['lastName'] = $lastName;
				$_SESSION['title'] = $title;
				$_SESSION['indivSDep'] = $departNo;
				$_SESSION['email'] = $email;
				$_SESSION['firstName'] = $firstName;
				$_SESSION['departName'] = $department;
				header("location:studentSUConPage.php");
				exit();
						}
					} else {}
				}
			} else {}

		} else {
			$report .="<div style='color:red;'>Sign up not successful</div>";
		}
	} else {}

?>

//formar generation of matric and department number 

			$insertData = "INSERT INTO studentsIn_normUni(id,matricNo,departNo,title,firstName,lastName,middleName,password,dateOfBirth,nationality,maritalStatus,religion,mobile1,mobile2,email,homeAddress1,homeAddress2,faculty,department,examType,examGrade,gender,study,verified,token,birthCertificate,level,date_made) VALUES (NULL,'0','0', '$title', '$firstName', '$lastName', '$middleName', '$password', '$dateOfBirth', '$nationality', '$maritalStatus', '$religion', '$mobile1','$mobile2', '$email', '$address1', '$address2', '$faculty', '$department', '$examType', '$examGrade', '$gender', '$study', 'NO', '0', '$birthCertificate', '$level', NOW())";
		$insertQuery = mysqli_query($db_conx, $insertData);

		//insering into the data base
		$insertData = "INSERT INTO studentsIn_normUni(id,matricNo,departNo,title,firstName,lastName,middleName,password,dateOfBirth,nationality,maritalStatus,religion,mobile1,mobile2,email,homeAddress1,homeAddress2,faculty,department,examType,examGrade,gender,study,verified,token,birthCertificate,level,date_made) VALUES (NULL,'0','0', '$title', '$firstName', '$lastName', '$middleName', '$password', '$dateOfBirth', '$nationality', '$maritalStatus', '$religion', '$mobile1','$mobile2', '$email', '$address1', '$address2', '$faculty', '$department', '$examType', '$examGrade', '$gender', '$study', 'NO', '0', '$birthCertificate', '$level', NOW())";
		$insertQuery = mysqli_query($db_conx, $insertData);
		if ($insertQuery) {
			//selecting the faculty and department digit from a diffrent table to form a matriculation number for the new student
			$selectInfo = "SELECT fNo_with_dNo FROM faculties_and_departments_in_norm WHERE faculty = '$faculty' AND  department = '$department' LIMIT 1";
			$infoQuery = mysqli_query($db_conx, $selectInfo);
			$checkInfo = mysqli_num_rows($infoQuery);
			if ($checkInfo > 0) {
				while ($row = mysqli_fetch_array($infoQuery)) {
					//faculty and department number from database
					$fAndDNumber = $row['fNo_with_dNo'];
					//getting current year
					$currentYear = date("y");
					$cFAndDNo = "";
					//adding 0 to the faculty and department digit
					if ($fAndDNumber < 1000) {
						$cFAndDNo .= "0".$fAndDNumber;
					} else {
						$cFAndDNo .= $fAndDNumber;
					}
					//check the database for the highest individual depatment number
					$selectISNo = "SELECT * FROM studentsIn_normUni WHERE faculty = '$faculty' AND  department = '$department' ORDER BY id DESC LIMIT 1,2";
					$queryISNo = mysqli_query($db_conx, $selectISNo);
					$checkISNo = mysqli_num_rows($queryISNo);
					if ($checkISNo > 0) {
						while ($row = mysqli_fetch_array($queryISNo)) {
							$departNo = $row['departNo'];
							//adding zeros to department numbers
							if ($departNo < 9) {
								$departNo = "00".$departNo+1;
							} else if ($departNo >=10 && $departNo < 99) {
								$departNo = "0".$departNo+1;
							} else {
								$departNo = $departNo+1;
							}
							$studentT = $row['title'];
							$mail = $row['email'];
							$firstNM = $row['firstName'];
							$departName = $row['department'];
							
							//the matriculation number
							$matriculationNumber = $currentYear.$cFAndDNo.$departNo;
							//fill the database matric number for this current student
												
								//hold the matric and lastname
							$_SESSION['matricNo'] = $matriculationNumber;
							$_SESSION['lastName'] = $lastName;
							$_SESSION['title'] = $studentT;
							$_SESSION['indivSDep'] = $departNo;
							$_SESSION['email'] = $email;
							$_SESSION['firstName'] = $firstNM;
							$_SESSION['departName'] = $departName;
							header("location:studentSUConPage.php");
							exit();
						}
					} else {}
				}
			} else {}
*/
?>
