<?php 
	session_start(); 
	$db = mysqli_connect('localhost', 'root', '', 'miniproject');

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	?>

<!DOCTYPE html>
<html>
<head>
</head>

<body style="margin:auto;margin-top:20%;background-image:url('/img/back7.jpg')">
<p><center><a href="daily.php" style="padding:2%;background-color:black;color:white;width:20%;">TODAY'S REPORT</a></center></p><br><br>
<p><center><a href="monthly.php" style="padding:2%;background-color:black;color:white;width:20%;">THIS MONTH</a></p><br></center><br>
<p><center><a href="alltime.php" style="padding:2%;background-color:black;color:white;width:20%;">ALL TIME</a></p><br></center><br>
</body>

</html>