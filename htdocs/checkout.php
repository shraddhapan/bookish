<?php
include('cart.php');

//session_start();

$host="localhost";
$user="root";
$password="";


$db=mysqli_connect($host,$user,$password);
mysqli_select_db($db,"miniproject");

$customer=$_SESSION['customerid'];

?>

<!DOCTYPE html>
<html>

<head>
<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
<style>
#content{
	margin:auto;
	padding:5%;
	background-color:white;
	width:50%;
	font-size:28px;
	margin-top:10%;
	text-align:center;
	font-family:'Poiret One', cursive;;


}
</style>
</head>

<body style="background-image:url('/img/back8.jpg')">
<div id="content">Your Order has been placed and will be delivered within 3 days...<br><br>Thankyou for shopping with us....<br><br><br>Happy Browsing!</div>

</body>
</html>