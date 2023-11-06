<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="TRHead">
		<div class="mPorHead">
			<div class="menuIcon" onclick="togMenu()"><span id="menuIc"><i class="fas fa-align-justify"></i></span><span class="closeMenu" id="closeX">X</span></div>
			<div class="mSchool">Norm University</div>
			<div class="mStuName">Welcome, <?php echo strtoupper($lastName); ?><i class="fas fa-user"></i></div>
			<div class="clearing"></div>
		</div>
		<div class="bigPorHead">
			<div class="floatL">Norm University</div>
			<div class="floatR">Welcome, <?php echo strtoupper($firstName).", ".$lastName; ?><i class="fas fa-user"></i></div>
			<div class="clearing"></div>
		</div>
	</div>
	<div class="GBg">
		<div class="mPorDetail" id="mainMenu">
			<div class="floatL LSPSSSec">
			<!-- links within staff navigations -->
				<div id="SPPPic"><img src="../staff/birthC_passP/<?php echo $PPName; ?>" class="imageCover"></div>
				<a class="SPSSMenu" href="portal.php"><i class="fas fa-bars MFont"></i>Profile</a>
				<a class="SPSSMenu" href="appointment.php"><i class="fas fa-bars MFont"></i>Appointments</a>
				<a class="SPSSMenu" href="course.php"><i class="fas fa-bars MFont"></i>Courses</a>
				<a class="SPSSMenu" href="assignment.php"><i class="fas fa-bars MFont"></i>Assignments</a>
				<a class="SPSSMenu" href="password.php"><i class="fas fa-bars MFont"></i>Change Password</a>
				<a class="SPSSMenu" href="logout.php"><i class="fas fa-bars MFont"></i>Logout</a>
			</div>
		</div>
		<div class="bigPordetail">
			<div class="floatL LSPSSSec">
			<!-- links within staff navigations -->
				<div id="SPPPic"><img src="../staff/birthC_passP/<?php echo $PPName; ?>" class="imageCover"></div>
				<a class="SPSSMenu" href="portal.php"><i class="fas fa-bars MFont"></i>Profile</a>
				<a class="SPSSMenu" href="appointment.php"><i class="fas fa-bars MFont"></i>Appointments</a>
				<a class="SPSSMenu" href="course.php"><i class="fas fa-bars MFont"></i>Courses</a>
				<a class="SPSSMenu" href="assignment.php"><i class="fas fa-bars MFont"></i>Assignments</a>
				<a class="SPSSMenu" href="password.php"><i class="fas fa-bars MFont"></i>Change Password</a>
				<a class="SPSSMenu" href="logout.php"><i class="fas fa-bars MFont"></i>Logout</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	var x = 0;
	function togMenu() {
		if (x == 0) {
			document.getElementById('menuIc').style.display = "none";
			document.getElementById('closeX'). style.display = "block";
			document.getElementById('mainMenu').style.display = "block";
			x = 1;
		} else {
			document.getElementById('menuIc').style.display = "block";
			document.getElementById('closeX'). style.display = "none";
			document.getElementById('mainMenu').style.display = "none";
			x = 0;
		}
	}
</script>
</body>
</html>