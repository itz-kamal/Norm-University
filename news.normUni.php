<?php
include_once("include/connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>news from norm university</title>
	<link rel="stylesheet" type="text/css" media="screen and (max-width:1440px)" href="css/familyPage.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/allNews.css">
</head>
<body>
<div class="THBg">
	<div><a href="index.php" class="BText01 floatL">Norm</a></div>
	<div class="BText02 floatL">News</div>
	<div class="SIn floatR"><input type="text" name="" placeholder="find stories"><i class="fas fa-search searchFont"></i></div>
	<div class="clearing"></div>
</div>
<div class="bgCrText">All news</div>
<div>
	<div>
		<?php
		$selAllNews = mysqli_query($db_conx, "SELECT * FROM news_events WHERE type ='news'");
		$checkNews = mysqli_num_rows($selAllNews);
		if ($checkNews > 0) {
			while ($row = mysqli_fetch_array($selAllNews)) {
				$newsImg = $row['image1'];
				$newsTypeo = $row['NType'];
				$newsTopic = $row['title'];
				$newsSub = $row['subHead'];
				$id = $row['id'];
				echo "<a href='current_news.php?n=$id' class='newsCard'>
						<div class='imgCon'>
							<img class='imageCover' src='admins/newsImages/$newsImg'>
						</div>
						<div class='newContSec'>
							<div class='newType'>$newsTypeo</div>
							<div class='newsTopic'>$newsTopic</div>
							<div class='newsBrief'>$newsSub</div>
						</div>
					</a>";
			}
		}
		?>
		
		<div class="clearing"></div>
	</div>
</div>
<div class="BBorder">
	<div class="fontSec">
		<span><i class="fab fa-facebook-f socialFonts"></i></span>
		<span><i class="fab fa-twitter socialFonts"></i></span>
		<span><i class="fab fa-youtube socialFonts"></i></span>
		<span><i class="fab fa-instagram-square socialFonts"></i></span>
		<span><i class="fab fa-linkedin-in socialFonts"></i></span>
	</div>
	<div>
		<div class="SText floatL">Norm</div>
		<div class="SText floatL Mright">University</div>
		<div class="floatL mFoot">
			<span class="LText">Terms of use</span>
			<span class="LText">Copywrite</span>
			<span class="LText">Privacy</span>
			<span class="LText">Trademarks</span>
			<span class="LText">Accessibility</span>
			<div class="LText">norm university,austra, australia962702</div>
		</div>
		<div class="clearing"></div>
	</div>
</div>
</body>
</html>