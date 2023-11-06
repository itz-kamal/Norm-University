<?php
include_once("include/connect.php");
$CId = $_GET['n'];
$select = mysqli_query($db_conx, "SELECT * FROM news_events WHERE id = '$CId' AND type ='news'");
$check = mysqli_num_rows($select);
if ($check > 0) {
	while ($row = mysqli_fetch_array($select)) {
		$mainImg = $row['image1'];
		$date = $row['date_made'];
		$title = $row['title'];
		$STitle = $row['subHead'];
		$content = $row['content'];
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>World News</title>
	<link rel="stylesheet" type="text/css" href="css/CNPage.css">
	<link rel="stylesheet" type="text/css" href="css/familyPage.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
</head>
<body>
	<div class="THBg">
		<div><a href="index.php" class="BText01 floatL">NORM</a></div>
		<div class="BText02 floatL">News</div>
		<div class="SIn floatR"><input type="text" name="" placeholder="find stories"></div>
		<div class="clearing"></div>
	</div>
	<div class="CNRSec">
		<div>
			<div class="CNMConts floatL">
				<div class="CNMImg"><img src="<?php echo "admins/newsImages/$mainImg";?>" class="imageCover"></div>
				<div class="CNPSText01"><?php echo "$date";?></div>
				<div class="CNPBText01"><?php echo "$title";?></div>
				<div class="CNPSText02"><?php echo "$STitle";?></div>
			</div>
			<div class="MONSec floatR">
				<div class="CNPBText02">What to Read Next :</div>
				<div class="SONSec">
					<?php 
					$OthSelect = mysqli_query($db_conx, "SELECT * FROM news_events WHERE type= 'news' LIMIT 6"); 
					$checkOth = mysqli_num_rows($OthSelect);
					if ($checkOth > 0) {
						while ($row = mysqli_fetch_array($OthSelect)) {
							$id = $row['id'];
							$date = $row['date_made'];
							$image = $row['image1'];
							$title = $row['title'];
							$id = $row['id'];
							//print them
							echo "<a href='current_news.php?n=$id' class='NPONews'>
								<div class='ONICon floatL'><img src='admins/newsImages/$image' class='imageCover'></div>
								<div class='ONCCon floatR'>
								<div class='CNPSText03'>$date</div>
								<div class='CNPBText03'>$title</div>
								</div>
								<div class='clearing'></div>
								</a>";
						}
						
					}
					?>
				</div>
			</div>
			<div class="clearing"></div>
		</div>
		<div class="CNMRSec">
			<?php echo "$content"; ?>
		</div>
		<div class="NWUMName">Media Contact</div>
		<div class="NWUDetails">Mary Jones, 09754083637, mary@norm.com</div>
	</div>
	<div class="CFReader">
		<div class="NUNews floatL">
			<div class="CNPSText04">Norm Report</div>
			<div class="ODFNRead">Recieve daily news from Norm</div>
			<input type="text" name="" placeholder="email" class="UVEmail">
			<input type="submit" name="" value="Signup" class="UNBtn">
		</div>
		<div class="MNRes floatL">
			<div class="CNPSText04">See also</div>
			<div><a href="" class="ODFNRead">More Norm News</a></div>
			<div><a href="" class="ODFNRead">Academic Resources</a></div>
		</div>
		<div class="MNRes floatL">
			<div class="CNPSText04">Weather</div>
			<div class="NCFont"><i class="fas fa-cloud-sun-rain"></i></div>
			<div class="ODFNRead">Norm Forecast</div>
		</div>
		<div class="MNRes floatL">
			<div class="CNPSText04">Events</div>
			<div class="NCFont"><i class="far fa-calendar-alt"></i></div>
			<div class="ODFNRead">Check upcoming events</div>
		</div>
		<div class="clearing"></div>
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
			<div class="floatL">
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