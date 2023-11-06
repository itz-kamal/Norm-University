<div class="mTopHead">
	<div class="normName floatL">
		<a href="index.php" class="topHeadL">Norm University</a>
	</div>
	<div class="floatR menuOptions">
		<div class="floatL"><i class="fas fa-search"></i></div>
		<div class="floatR togMenu" onclick="toggleMenu()">
			<span id="curFont1"><i class="fas fa-align-justify"></i> menu</span>
			<span id="curFont2"><span style="padding-right: 2px;">x</span> close</span>
		</div>
		<div class="clearing"></div>
	</div>
	<div class="clearing"></div>
	<div class="menuDiv" id="optMenu">
		<div class="majorMenu">
			<span><a href="" class="eachSpac rightBr">News</a></span>
			<span><a href="" class="eachSpac">Events</a></span>
		</div>
		<div class="majorMenu">
			<span><a href="academics.php" class="eachSpac rightBr">Academics</a></span>
			<span><a href="campusLife.php" class="eachSpac">Campus Life</a></span>
		</div>
		<div class="majorMenu">
			<span><a href="admission.php" class="eachSpac rightBr">Admission</a></span>
			<span><a href="aboutNorm.php" class="eachSpac">About Norm</a></span>
		</div>
		<div>
			<div class="ourMenuT">
				<span class="ourLinks"><a href="studentPage.php" class="linkText">Students</a></span>
				<span class="ourLinks"><a href="f_sPage.php" class="linkText">Faculty & Staff</a></span>
				<span class="ourLinks"><a href="familyPage.php" class="linkText">Families</a></span>
			</div>
			<div class="ourMenuB">
				<span class="ourLinks2"><a href="visitors.php" class="linkText">visitors</a></span>
				<span class="ourLinks2"><a href="donate.php" class="linkText">Donate</a></span>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var x = 0;
	function toggleMenu() {
		if (x == 0) {
			x = 1;
			document.getElementById('curFont1').style.display = "none";
			document.getElementById('curFont2').style.display = "block";
			document.getElementById('optMenu').style.display = "block";
		} else {
			x = 0;
			document.getElementById('curFont1').style.display = "block";
			document.getElementById('curFont2').style.display = "none";
			document.getElementById('optMenu').style.display = "none";
		}
	}
</script>