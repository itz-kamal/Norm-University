<!DOCTYPE html>
<html>
<head>
	<title>Family and staff page</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="css/SPcss.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="css/mobileNorm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="css/mobileStuPage.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
</head>
<body>
	<div>
		<?php include_once("include/mobileMenu.php"); ?>
		<?php include_once("include/THSections.php"); ?>
	</div>
	<div class="SPMcontent">
		<div class="HTag">Faculty & Staffs</div>
		<div class="NSec floatL FS90">
			<div class="SPHead">Academic Resources</div>
			<a class="SPLink" href="javascript: window.open('staff/signIn.php')">Staff Portal</a>
			<a class="SPLink" href="javascript: window.open('staff/signUp.php')">New Staff</a>
			<a href="library.php" class="SPLink">Library</a>
			<a href="A-Z_courses.php" class="SPLink">Course Search</a>
			<a href="A-Z_courses.php" class="SPLink">Course Catalogue</a>
			<div class="SPLink">General Announcement</div>
			<div class="SPLink BTLine"></div>
			<div class="SPHead">Related Links</div>
			<div class="SPLink">Events Calender</div>
			<div class="SPLink">Upcoming Webniars</div>
			<div class="SPLink BTLine">Research</div>
			<div class="SPHead">Upcoming Events</div>
			<div class="SPLink">There is no events at this time please check back soon at norm events.</div>
			<div class="SPLink">norm events</div>
		</div>
		<div class="NSContent floatR">
			<div class="SPImgs">
				<img src="images/classRoom.jpg" class="imageCover">
			</div>
			<div class="FS90">
				<div class="GTColor">Discoveries for students concering related issues on researches. coonecting over 15,000 students. building out the potentials in them, providing more sophisticated porfessionals in the community.</div>
				<div>
					<div class="SPMSec">
						<div class="SPBText GTColor">Undergraduates</div>
						<ul>
							<li class="SPMore floatL">Career advancements</li>
							<li class="SPMore floatL">Jobs and Intenships</li>
							<div class="clearing"></div>
							<li class="SPMore floatL">Students Research Programs</li>
							<li class="SPMore floatL">Norm career programs</li>
							<div class="clearing"></div>
						</ul>
					</div>
					<div class="SPMSec">
						<div class="SPBText GTColor">Graduates</div>
						<ul>
							<li class="SPMore floatL">Career advancements for master's <br/> and PHD students</li>
							<li class="SPMore floatL">Law school</li>
							<div class="clearing"></div>
							<li class="SPMore floatL">Medical School</li>
							<li class="SPMore floatL">Norm career programs</li>
							<div class="clearing"></div>

						</ul>
					</div>
					<div class="SPMSec">
						<div class="SPBText GTColor">Finacial Supports</div>
						<ul>
							<li class="SPMore floatL">Busar's Office</li>
							<li class="SPMore floatL">Student Employments</li>
							<div class="clearing"></div>

							<li class="SPMore floatL">Tution Information</li>
							<li class="SPMore floatL">Grants and scholarship</li>
							<div class="clearing"></div>

							<li class="SPMore floatL">Benefits from donors</li>
							<div class="clearing"></div>

						</ul>
					</div>
					<div class="SPMSec">
						<div class="SPBText">Health & Safety</div>
						<ul>
							<li class="SPMore floatL">Students health and counseling <br/> sercives</li>
							<li class="SPMore floatL">Student disablity and overall support</li>
							<div class="clearing"></div>

							<li class="SPMore floatL">Health Insurance scheme</li>
							<li class="SPMore floatL">Emergency and crisis team</li>
							<div class="clearing"></div>

						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="clearing"></div>
	</div>
	<?php include_once("include/mainFooter.php"); ?>
</body>
</html>