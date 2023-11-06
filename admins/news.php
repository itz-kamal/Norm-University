<?php
$db_conx = mysqli_connect("localhost", "root", "root", "normUni");
if (isset($_POST['submit1']) && !empty($_POST['Ntitle']) && !empty($_POST['Ntype']) && !empty($_POST['NCon']) && !empty($_FILES['NImg']['name']) && !empty($_FILES['NImg']['tmp_name']) && !empty($_FILES['NImg']['size'])) {
	$Ntitle = htmlentities($_POST['Ntitle']);
	$NSHead = htmlentities($_POST['subHead']);
	$Ntype = htmlentities($_POST['Ntype']);
	$NCon = htmlentities($_POST['NCon']);
	$appear = htmlentities($_POST['appear']);
	//news images files
	$NImgName = $_FILES['NImg']['name'];
	$NImgTmp = $_FILES['NImg']['tmp_name'];
	$NImgSize = $_FILES['NImg']['size'];
	$NImgError = $_FILES['NImg']['error'];
	$kaboom1 = explode(".",$NImgName);
	$NINExt = end($kaboom1);
	
	//checking extensions
	$NINECheck = $NINExt == "png" || $NINExt == "jpeg" || $NINExt == "jpg" || $NINExt == "gif";
	
	if ($NImgError == 0) {
		move_uploaded_file($NImgTmp, "newsImages/$NImgName");
		$insertNews = "INSERT INTO news_events(id,type,title,subHead,NType,content,image1,appear,date_made) VALUES(NULL,'news','$Ntitle','$NSHead','$Ntype','$NCon','$NImgName','$appear',NOW())";
		$INQuery = mysqli_query($db_conx, $insertNews);
		if ($INQuery) {
			$report .="<div style='color:green;'>News Post successful</div>";
		} else {
			$report .="<div style='color:red;'>Post error</div>";
		}
	} else {
		$report .="<div style='color:red;'>File error error</div>";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Norm Admins</title>
	<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/news.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
	<div>
		<?php include_once("navSec.php"); ?>
			<div class="ARCon floatR">
				<div class="NBText01">News</div>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
					<div>
						<div class="NPSec">Post Latest News Contents</div>
						<div class="NPCSec">
							<div style="margin-bottom: 15px;"><?php echo $report; ?></div>
							<div class="NHead">Title : </div>
							<div><input type="text" name="Ntitle"class="NHCon"></div>
							<div class="NHead">Sub Topic : </div>
							<div><input type="text" name="subHead" class="NHCon"></div>
							<div class="NHead">News Type : </div>
							<select class="NHCon" name="Ntype">
								<option>--Type--</option>
								<option value="Entertainment">Entertainment</option>
								<option value="Politics">Politics</option>
								<option value="Tech & Science">Tech & Science</option>
								<option value="Sport">Sport</option>
								<option value="Business">Business</option>
								<option value="Foreign News">Foreign News</option>
								<option value="Local news">Local news</option>

							</select>
							<div class="NHead">News Content : </div>
							<div><textarea name="NCon"  class="NMCon" rows="25" cols="50"></textarea></div>
							<div class="NHead">Image : </div>
							<div><input type="file" name="NImg" style="margin: 10px 0;"></div>
							<div class="NHead">Appear : </div>
							<select name="appear" style="width: 20%; margin: 10px 0; padding: 5px; border: 2px solid gray;">
								<option value="2">2</option>
								<option value="1">1</option>
								<option value="3">3</option>
							</select>

							<div><input type="submit" value="POST" class="PBtn" name="submit1"></div>
						</div>
					</div>
					<div>
						<div class="NPSec">Update past News Contents</div>
					</div>
				</form>
			</div>
			<div class="clearing"></div>
		</div>
	</div>
</body>
</html>