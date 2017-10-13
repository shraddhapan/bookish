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
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster|Lobster+Two" rel="stylesheet">
	<title>
	
myprofile	
	</title>

<style>

#full{

}

#head{
	margin-top:1%;
	padding:20px;
	font-family: 'Lobster Two', cursive;
	text-align:center;
	background-color: #29292d;
	color:white;
}

#details{
	height:500px;
	width:100%;
	
	background-repeat: no-repeat;
	background-size: 100% 500px;
	margin-top:0;
	background-position: fixed;


}

img{
	height:100%;
	width:100%;
}

#det1{
	
	
	margin-left:25%;
	margin-right:25%;
	
	height:45%;
	padding:2%;
	text-align:center;
	background-color:white;
	font-size:24px;

}

#orderlist{
	margin-top:5%;
	text-align:center;
	margin-bottom:5%;
	background-color: #29292d;
	padding:2%;
	margin-right:8%;
	margin-left:8%;
	color:white;

}
</style>
</head>
<body style="background-image:url('/img/back8.jpg')">
<div id="full">
	<div id="head">
	<h1>User Profile</h1>
	</div>
<?php 
$list=mysqli_query($db,"select * from customer where id=$customer");
$row=mysqli_fetch_array($list);
?>

<div id="details">
<div style="height:100px"></div>
<div id="det1">
<p ><b>Username:</b><?php echo $row{'username'};?></p>
<p><b>Mobile number:</b><?php echo $row{'mobileno'};?></p>
<p><b>Email-id:</b><?php echo $row{'email'}; ?></p>
<p><b>Your id in system is :</b><?php echo $row{'id'}; ?></p></div>
</div>

<div id="orderlist">
<h1>Your list of orders</h1>
<div style="font-size:18px;background-color:white;padding:2%;color:black">
<?php
$sqli = mysqli_query($db,"select o.date,o.amount,o.id from orders o where o.customerid=$customer ;");
//$sqli = mysqli_query($db,"SELECT * FROM orders");
while($result = mysqli_fetch_array($sqli))

{

echo "<p><a href=order.php?orderid=".$result{'id'}.">";
?>

date      :    <?php  echo $result['date']."     ";     ?>  
amount    :    <?php  echo $result['amount'] ; ?>  <br>

<?php
echo "</a></p>";
}  			
?>
</div>
</div>
</body>
</html>