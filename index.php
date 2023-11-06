<?php
include_once("include/connect.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>University of Art Technology Culture and Science Study</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="css/norm.css">
	<link rel="stylesheet" type="text/css" media="screen and (max-width:768px)" href="css/mobileNorm.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@600&display=swap" rel="stylesheet">
</head>
<body>
	<!-- head section -->
	<header id="bgImg">
		<div class="overlay01">
			<?php include_once("include/mobileMenu.php"); ?>
			<div class="topHead">
				<a href="index.php" class="topHeadL">Norm University</a>
				<a href="studentPage.php" class="normLinks">Students</a>
				<a href="f_sPage.php" class="normLinks">Faculty & Staff</a>
				<a href="familyPage.php" class="normLinks">Families</a>
				<a href="visitors.php" class="normLinks">visitors</a>
				<a href="donate.php" class="normLinks borderL">Donate</a>
				<span class="searchBox"><i class="fas fa-search searchFont"></i><input type="text" name="homeSearch" class="genSearch"></span>
			</div>
			<!-- navigation on the index page news, events, admission e.t.c-->
			<div class="normNav">
				<ul>
					<li class="uniList"><a href="#" class="uniNav">News</a></li>
					<li class="uniList"><a href="#" class="uniNav">Events</a></li>
					<li class="uniList"><a href="academics.php" class="uniNav">Academics</a></li>
					<!--
					<li class="uniList"><a href="#" class="uniNav">Research</a></li>
					-->
					<li class="uniList"><a href="campusLife.php" class="uniNav">Campus Life</a></li>
					<li class="uniList"><a href="admission.php" class="uniNav">Admission</a></li>
					<li class="uniList"><a href="aboutNorm.php" class="uniNav">About Norm</a></li>
				</ul>
			</div>
			<!-- school logo container-->
			<div id="normLogo">
				<img src="images/schoolLogo.png" alt="Faculty of Art Building" class="imageCover">

			</div>
			<!-- animated slide up text (explore norm)-->
			<marquee id="exploreLink" direction="up">
				<div>Explore Norm</div>
				<div><i class="fas fa-chevron-up slideUpFont"></i></div>
				<div><i class="fas fa-chevron-up slideUpFont"></i></div>
			</marquee>
			<!--
			<div>
				<div>Explore Norm</div>
				<div><i class="fas fa-chevron-up slideUpFont"></i></div>
				<div><i class="fas fa-chevron-up slideUpFont"></i></div>
			</div>
		-->
		</div>
	</header>
	<!-- head section ends here...
	 ...news section starts here-->
	<div class="bgPad bgcCream">
		<div class="topic01">Norm News</div>
		<div class="writeUp01">Latest news updates from Norm</div>
		<div>
			<?php
			//the first news with css background image
			$selectNews = mysqli_query($db_conx, "SELECT * FROM news_events WHERE type = 'news' AND appear = '1' LIMIT 1");
			$checkNews = mysqli_num_rows($selectNews);
			if ($checkNews > 0) {
				while ($row = mysqli_fetch_array($selectNews)) {
					$newsType = $row['NType'];
					$newsImg = $row['image1'];
					$title = $row['title'];
					$id = $row['id'];
					echo "<a href='current_news.php?n=$id' id='news01' style='background-image:url(admins/newsImages/$newsImg);'>
						<div class='News01Desc newsDesc'>
							<div class='NDtype01'>$newsType</div>
							<div class='IPWNews'>$title</div>
						</div>
						</a>";
				}
			}
			//the other two news after the first wide one
			$selectNews = mysqli_query($db_conx, "SELECT * FROM news_events WHERE type = 'news' AND appear = '2' LIMIT 2");
			$checkNews = mysqli_num_rows($selectNews);
			if ($checkNews > 0) {
				while ($row = mysqli_fetch_array($selectNews)) {
					$newsType = $row['NType'];
					$newsImg = $row['image1'];
					$title = $row['title'];
					$id = $row['id'];
					echo "<a href='current_news.php?n=$id' class='newsCard'>
							<div class='newsImg'><img src='admins/newsImages/$newsImg' class='imageCover'>
							</div>
							<div class='newsDesc01 newsDesc'>
								<div class='NDtype'>$newsType</div>
								<div class='NDcontent'>$title</div>
							</div>
						</a>";
				}
			}

			?>
			<div class="clearing"></div>

		</div>
		<div class="midSec">
			<?php
			//bottom div of news feeds
			$selectNews = mysqli_query($db_conx, "SELECT * FROM news_events WHERE type = 'news' AND appear = '3' LIMIT 4");
			$checkNews = mysqli_num_rows($selectNews);
			if ($checkNews > 0) {
				while ($row = mysqli_fetch_array($selectNews)) {
					$newsType = $row['NType'];
					$newsImg = $row['image1'];
					$title = $row['title'];
					$id = $row['id'];
					echo "<a href='current_news.php?n=$id' class='newsCard'>
							<div class='newsImg'><img src='admins/newsImages/$newsImg' class='imageCover'>
							</div>
							<div class='newsDesc01 newsDesc'>
								<div class='NDtype'>$newsType</div>
								<div class='NDcontent'>$title</div>
							</div>
						</a>";
				}
			}
			?>
			<div class="clearing"></div>
		</div>
		<!-- more news button description below-->
		<div class="centerText">
			<a href="news.normUni.php" class="moreFeed">More News</a>
		</div>
	</div>
	<!-- news section ends here...
		events section starts here-->
	<div class="bgPad bgcDarkwheat">
		<div class="topic01">Norm Events</div>
		<div class="writeUp01">Upcoming events in Norm</div>
		<div>
			<a class="eventCard" href="#">
				<div class="newsImg">
					<img src="images/eventImages/waste.jpg" class="imageCover">
				</div>
				<div class="eventDate">
					<div class="EDmonth">NOV</div>
					<div>18</div>
				</div>
				<div class="eventDesc">
					<div class="NDtype">Seminar</div>
					<div class="mEventTopic">Producing Electricity from waste</div>
					<div class="Etime">2:45PM</div>
				</div>
				<div class="clearing"></div>
			</a>
			<a href="" class="eventCard">
				<div class="newsImg">
					<img src="images/eventImages/micImg.jpg" class="imageCover">
				</div>
				<div class="eventDate">
					<div class="EDmonth">NOV</div>
					<div>23</div>
				</div>
				<div class="eventDesc">
					<div class="NDtype">Seminar</div>
					<div class="mEventTopic">Norm annual debate competition</div>
					<div class="Etime">12:00PM</div>
				</div>
				<div class="clearing"></div>
			</a>
			<a href="" class="eventCard">
				<div class="newsImg">
					<img src="images/eventImages/depression.jpg" class="imageCover">
				</div>
				<div class="eventDate">
					<div class="EDmonth">NOV</div>
					<div>30</div>
				</div>
				<div class="eventDesc">
					<div class="NDtype">Seminar</div>
					<div class="mEventTopic">Avoiding depression and low mood</div>
					<div class="Etime">10:20AM</div>
				</div>
				<div class="clearing"></div>
			</a>
			<a href="" class="eventCard">
				<div class="newsImg">
					<img src="images/eventImages/seaVirus.jpg" class="imageCover">
				</div>
				<div class="eventDate">
					<div class="EDmonth">DEC</div>
					<div>03</div>
				</div>
				<div class="eventDesc">
					<div class="NDtype">Seminar</div>
					<div class="mEventTopic">Impacts of sea micro organism in Covid-19</div>
					<div class="Etime">01:30PM</div>
				</div>
				<div class="clearing"></div>
			</a>
			<div class="clearing"></div>
		</div>
		<div class="centerText">
			<a href="" class="moreFeed">More Events</a>
		</div>
	</div>
	<!-- event section ends here...
		academic section starts here-->
	<div class="bgPad">
		<div class="topic01">Academics</div>
		<div class="writeUp01">Bringing out an expiring mind, stretched by new ideas, may never return to its original dimensions</div>
		<div>
			<div class="academicSec">
				<div class="AcademicImg"><img src="images/underGEdu.jpg" class="imageCover"></div>
				<div class="NDtype magT">Undergradute Education</div>
				<div class="educate newsDesc">University graduates gain professional qualifications that are recognised and respected worldwide. University graduates are offered higher pay and greater financial stability.</div>
				<a href="#" class="schoolType">Undergraduate Education</a>
			</div>
			<div class="academicSec">
				<div class="AcademicImg"><img src="images/graduateEdu.jpg" class="imageCover"></div>
				<div class="NDtype magT">Gradute Education</div>
				<div class="educate newsDesc">With a Graduate degree from Norm University you become an expert in your field and improve your career prospects by engaging in advanced studies and research at the world's best universities.</div>
				<a href="#" class="schoolType">Graduate Education</a>
			</div>
			<div class="academicSec">
				<div class="AcademicImg"><img src="images/bussinessMan.jpg" class="imageCover"></div>
				<div class="NDtype magT">Bussiness Education</div>
				<div class="educate newsDesc">Applicants with business education have higher chances of being hired. That is another fact that is undoubtful. Companies save plenty of time and money when dealing with MBA degree holders.</div>
				<a href="#" class="schoolType">Business Education</a>
			</div>
			<div class="clearing"></div>
		</div>
		<div class="moreAcademi">
			<a href="#" class="MAlist">Law</a>
			<a href="#" class="MAlist borderL">Engineering</a>
			<a href="#" class="MAlist borderL">Health Science</a>
			<a href="#" class="MAlist borderL">Medicine</a>
			<a href="" class="MAlist borderL">Accounting</a>
		</div>
		<div class="centerText">
			<a href="academics.php" class="moreFeed">More About Academics</a>
		</div>
	</div>
	<!-- Academic section ends here...
	 ...inspiration section starts here-->
	<div class="inspire">
		<video class="imageCover" autoplay="true" muted="true">
			<source src="grow.m4v" type="video/mp4">
		</video>
	</div>
	<!-- inspiration section ends here...
	 ...Research section starts here-->
	 <!--
	<div class="bgPad bgcCream">
		<div class="topic01">Research</div>
		<div class="writeUp01">Innovative discoveries from Norm creating collaboration the drives our health and intellectual life to a better future</div>
		<div>
			<a href="#">
				<div class="newsCard">
						<div class="newsImg"><img src="images/research/quantumHole.jpg" class="imageCover"></div>
						<div class="NDtype newsDesc01">science</div>
						<div class="newsDesc newsDesc01">Atomic clocks could detect exotic low-mass fields from merging black holes</div>
				</div>
			</a>
			<a href="#">
				<div class="newsCard">
						<div class="newsImg"><img src="images/research/medical.jpg" class="imageCover"></div>
						<div class="NDtype newsDesc01">medical</div>
						<div class="newsDesc newsDesc01">3D printed fibres make efficient respiratory sensors</div>
				</div>
			</a>
			<a href="#">
				<div class="newsCard">
						<div class="newsImg"><img src="images/research/computing.jpg" class="imageCover"></div>
						<div class="NDtype newsDesc01">computing</div>
						<div class="newsDesc newsDesc01">How capable are today's quantum computers?</div>
				</div>
			</a>
			<a href="#">
				<div class="newsCard">
						<div class="newsImg"><img src="images/research/atomic.jpg" class="imageCover"></div>
						<div class="NDtype newsDesc01">science</div>
						<div class="newsDesc newsDesc01">Plantes and stars could form as 'siblings' at the same time</div>
				</div>
			</a>
			<div class="clearing"></div>
		</div>
		<div class="centerText">
			<a href="#" class="moreFeed">More Research</a>
		</div>
	</div>
	-->
	<!-- Research section ends here...
	 ...campus Life section starts here-->
	<div class="bgPad bgcDarkwheat">
		<div class="topic01">Campus Life</div>
		<div class="writeUp01">While in Norm student explore the truth behind avail communication and exposure with other students</div>
		<div>
			<div class="CampusSecL">
				<div class="campusImg floatL CI01 CImage">
					<img src="images/leftEdge.png" class="imageCover floatR edgeImg">
				</div>
				<div class="CSlink floatL"><a href="#">Athletic & Fitness</a></div>
				<div class="clearing"></div>
			</div>
			<div class="CampusSecR">
				<div class="campusImg floatL CI02 CImage">
					<img src="images/leftEdge.png" class="imageCover floatR edgeImg">
				</div>
				<div class="CSlink floatL"><a href="#">Art & Culture</a></div>
				<div class="clearing"></div>
			</div>
			<div class="clearing"></div>
		</div>
		<div>
			<div class="CampusSecL">
				<div class="CSlink floatL"><a href="#">Library</a></div>
				<div class="campusImg floatL CI03 CImage">
					<img src="images/rightEdge.png" class="imageCover floatL edgeImg">
				</div>
				<div class="clearing"></div>
			</div>
			<div class="CampusSecR">
				<div class="CSlink floatL"><a href="#">Students Life</a></div>
				<div class="campusImg floatL CI04 CImage">
					<img src="images/rightEdge.png" class="imageCover floatL edgeImg">
				</div>
				<div class="clearing"></div>
			</div>
			<div class="clearing"></div>
		</div>
		<div>
			<div class="CampusSecL">
				<div class="campusImg floatL CI05 CImage">
					<img src="images/leftEdge.png" class="imageCover floatR edgeImg">
				</div>
				<div class="CSlink floatL"><a href="#">Medical Center</a></div>
				<div class="clearing"></div>
			</div>
			<div class="CampusSecR">
				<div class="campusImg floatL CI06 CImage">
					<img src="images/leftEdge.png" class="imageCover floatR edgeImg">				
				</div>
				<div class="CSlink floatL"><a href="#">Religious House</a></div>
				<div class="clearing"></div>
			</div>
			<div class="clearing"></div>
		</div>
		<div class="centerText"><a href="campusLife.php" class="moreFeed">More on Campus Life</a></div>
	</div>
	<!-- Campus Life section ends here...
	 ...Admission section starts here-->
	<div class="bgPad">
		<div class="topic01">Admission</div>
		<div class="writeUp01">Securing your admission opportunity into Norm</div>
		<div>
			<div class="admissionSec floatL mHide"><img src="images/admissionImg01.jpg" class="imageCover"></div>
			<div class="admissionSec floatR"><img src="images/admissionImg02.jpg" class="imageCover"></div>
		</div>
		<div>
			<div class="campusImg floatL mHide">
				<div class="NDtype">Admission programs  into Norm</div>
				<div class="newsDesc">About 3,500 freshmen admission secured each year. Other programs like Diploma, Jupeb, Transfer students, Bussiness Education, Distance learning and Graduate education open to applicats.</div>
			</div>
			<div class="campusImg floatR">
				<div class="NDtype">admission Financial Aids</div>
				<div class="newsDesc">Norm meets the full financial aid of every stundents makin g it easy to cope through the years in schools even for parents earing below $47,000.</div>
			</div>
			<div class="clearing"></div>
		</div>
		<div class="centerText"><a href="admission.php" class="moreFeed">More Admission Updates</a></div>
	</div>
	<!-- Admission section ends here...
	 ...About Norm section starts here-->
	<div class="mountImg">
		<div class="bgPad overlay01">
			<div class="topic01">About Norm</div>
			<div class="writeUp01">A place for learning, discovery, innovation, expression and disclosure</div>
			<div class="aboutSec ASMtop">
				<div class="AScont">
					<div>Open</div>
					<div class="AStext">1992</div>
				</div>
				<div class="AScont">
					<div>Students</div>
					<div class="AStext">23,653</div>
				</div>
				<div class="AScont">
					<div>Faculty</div>
					<div class="AStext">746</div>
				</div>
			</div>
			<div class="aboutSec">
				<div class="AScont">
					<div>Institute</div>
					<div class="AStext">7 disciplines</div>
				</div>
				<div class="AScont">
					<div>Libraries</div>
					<div class="AStext">13 volume</div>
				</div>
				<div class="AScont">
					<div>Research Budget</div>
					<div class="AStext">$738 million </div>
				</div>
			</div>
			<div class="centerText"><a href="aboutNorm.php" class="moreFeed">More About Norm</a></div>
		</div>
	</div>
	<!-- About Norm section ends here...
	 ...Footer section starts here-->
	<?php include_once("include/mainFooter.php"); ?>
</body>
<script type="text/javascript">
	var screenHeight = window.innerHeight+"px";
	document.querySelector('#bgImg').style.height = screenHeight;
	document.querySelector('.overlay01').style.height = screenHeight;
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
</html>