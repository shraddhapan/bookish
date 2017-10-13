<?php 
	session_start(); 
	$db = mysqli_connect('localhost', 'root', '', 'miniproject');

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin-Home</title>
	<style>

	#full{
		width:80%;
		margin-left:10%;
		list-style-type: none;
		height:500px;
	}

	#oplist{
		list-style-type: none;
		width:100%;
		margin:auto;
		padding-bottom:6%;
		background-color:white;
		padding-top:2%;
		
	}

	#ops{
		float:left;
		width:17%;
		padding:1%;
		text-align:center;
		font-size:22px;
		color:white;

	}
	a:link, a:visited{
		color:white;
		text-decoration: none;
	}

	.two{
		width:37%;
		float:left;
		background-color:white;
		height:100%;
		overflow:auto;
		padding:5%;
		margin-left:-2%;
		font-size:18px;

	}

	.one{
		width:37%;
		margin-right:4%;
		float:right;
		background-color: white;
		margin-left:-5%;
		height:100%;
		overflow:auto;
		font-size:18px;
		padding:5%;
	

	}

	#cap{
		margin:auto;
		margin-top:-10%;
		padding:4%;
		margin-left:-10%;
		width:112%;
		background-color:#404040;
		color:white;
	}

	#r{
		width:15%;
		padding:2%;
		text-align:center;
		background-color:#bfbfbf;
		margin-right:0;
	}

	#table{
		width:90%;
		margin-left:5%;
		margin-bottom:3%;
		font-size:18px;
	}
	</style>
	
</head>


<body  style="background-image:url('/img/back7.jpg')">

	
		<ul id="oplist">

			<li id="ops" style="background-color: #5c8a8a;margin-left:2%;"><a href="update.php"> Update </a></li>
			<li id="ops" style="background-color:#404040"><a href="addbook.php" > Addbook</a></li>
			<li id="ops" style="background-color: #5c8a8a"><a href="searchbook.php"> Search </a></li>
			<li id="ops" style="background-color:#404040"><a href="delete.php"> Delete </a></li>
			<li id="ops" style="background-color: #5c8a8a"><a href="index.php?logout='1'" >Logout</a></li>
			
		</ul>
		
		
<br>
<div>
<ul id="full">
<li class="two">
<h2 id="cap">All Time Bestsellers</h2>

<p ><?php

	$viewquery = mysqli_query($db,"SELECT * from book  order by sale desc");        //edit the query here
	$s=1;
	while($row = mysqli_fetch_array($viewquery) and $s<=10)
	{
		echo $s.". ".$row['title']."  :  ".$row['sale'];  $s++;?> <br><br>
		<?php  
	}
?></p>
</li>

<li class="one">
<h2 id="cap">All time worst sellers</h2>


<p><?php

	$viewquery = mysqli_query($db,"SELECT * from book  order by sale  asc ");       //edit the query here
	$s=1;
	while($row = mysqli_fetch_array($viewquery) and $s<=10)
	{
		echo $s.". ".$row['title']."  :  ".$row['sale'];  $s++;?> <br><br>
		<?php  
	}
?></p>
</li>
</ul>
</div>


<div style="margin-top:10%;background-color:white;padding-top:2%;padding-bottom:2%">

<h2 style="text-align:center;">Sale Statistics for last 5 months</h2>
<table id="table">
	<tr>
		<th id="r" style="background-color:#404040;color:white">This month</th>
		<th id="r" style="background-color:black;color:white">1 month ago</th>
		<th id="r" style="background-color:#404040;color:white">2 months ago</th>
		<th id="r" style="background-color:black;color:white">3 months ago</th>
		<th id="r" style="background-color:#404040;color:white">4 months ago</th> 
	</tr>
	<tr>
		<td id="r"><?php $result=mysqli_query($db,"SELECT sum(quantity) AS value_sum FROM order_p op,orders o WHERE o.id=op.orderid and o.date > DATE_SUB(NOW(), INTERVAL 1 MONTH)");$row=mysqli_fetch_assoc($result);echo $row['value_sum']; ?></td>
		<td id="r"><?php $result=mysqli_query($db,"SELECT sum(quantity) AS value_sum FROM order_p op,orders o WHERE o.id=op.orderid and o.date > DATE_SUB(NOW(), INTERVAL 2 MONTH) and o.date < DATE_SUB(NOW(),INTERVAL 1 MONTH)");$row=mysqli_fetch_array($result);echo $row['value_sum']; ?></td>
		<td id="r"><?php $result=mysqli_query($db,"SELECT sum(quantity) AS value_sum FROM order_p op,orders o WHERE o.id=op.orderid and o.date > DATE_SUB(NOW(), INTERVAL 3 MONTH) and o.date < DATE_SUB(NOW(),INTERVAL 2 MONTH)");$row=mysqli_fetch_array($result);echo $row['value_sum']; ?></td>
		<td id="r"><?php $result=mysqli_query($db,"SELECT sum(quantity) AS value_sum FROM order_p op,orders o WHERE o.id=op.orderid and o.date > DATE_SUB(NOW(), INTERVAL 4 MONTH) and o.date < DATE_SUB(NOW(),INTERVAL 3 MONTH)");$row=mysqli_fetch_array($result);echo $row['value_sum']; ?></td>
		<td id="r"><?php $result=mysqli_query($db,"SELECT sum(quantity) AS value_sum FROM order_p op,orders o WHERE o.id=op.orderid and o.date > DATE_SUB(NOW(), INTERVAL 5 MONTH) and o.date < DATE_SUB(NOW(),INTERVAL 4 MONTH)");$row=mysqli_fetch_array($result);echo $row['value_sum']; ?></td>
	</tr>
</table>
<center><a href='report.php' style="padding:2%;background-color:black;color:white">CLICK HERE FOR REPORT</a></center>
</div>
</body>
</html>