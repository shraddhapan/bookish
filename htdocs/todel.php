<?php 

session_start();

// variable declaration
$id = "";
$username = "";
$email    = "";
$mobileno = "";
//$customerid=$_SESSION['customerid'];
$customerid=$_SESSION['customerid'];
$db = mysqli_connect('localhost', 'root', '', 'miniproject');

if (isset($_POST['del']))
{

	//$url=mysqli_real_escape_string($db, $_POST['oldpage']);
	
	$cartid=mysqli_real_escape_string($db, $_POST['cartid']);
	$bookid=mysqli_real_escape_string($db, $_POST['todel']);

	mysqli_query($db,"delete from cartitems where bookid='$bookid' and cartid='$cartid'");
	//echo $cartid,$bookid;
	header('location: home.php');
}

?>