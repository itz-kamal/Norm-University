<?php 
include_once("../include/connect.php");
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$date = htmlentities($_POST['date']);
	$insert = mysqli_query($db_conx, "INSERT INTO testing(id,name,datee) VALUES (NULL, '$name', '$date')");
	if ($insert) {
		echo "yes";
	} else {
		echo "no";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>omo</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
		<div>name</div>
		<input type="text" name="name">
		<div>date</div>
		<input type="date" name="date">
		<input type="submit" name="submit">
	</form>
</body>
</html>