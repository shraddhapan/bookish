<?php 
	session_start(); 
	$db = mysqli_connect('localhost', 'root', '', 'miniproject');

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	$s=1;
	?>

<!DOCTYPE html>
<html>
<head>
<style>
table{
	border-collapse:collapse;
	background-color:white;
	width:80%;
	padding:2%;
	margin:auto;
}
th{
	width:20%;
	border:1px solid #404040;
	border-collapse:collapse;
	text-align:center;
	padding:2%;
}

td{
	width:20%;
	border:1px solid #404040;
	border-collapse:collapse;
	text-align:center;
	padding:2%;
}
</style>
</head>


<body style="background-image:url('/img/back7.jpg')">
<table>
	<tr>
		<th>S.no</th>
		<th>Customer-ID</th>
		<th>PURCHASE AMOUNT</th>
		<th>BOOKS</th>
	</tr>
	<?php 
	$query=mysqli_query($db,"SELECT * from customer");
	while($row=mysqli_fetch_array($query))
	{
	$cust=$row{'id'};
	?>
	<tr>
	<td><?php echo $s; ?></td>
	<td><?php echo $cust ;?></td>
	<td><?php $result=mysqli_query($db,"SELECT sum(amount) as sum1 from orders where customerid=$cust and date=CURDATE()") ; $row=mysqli_fetch_array($result); echo $row{'sum1'};?></td>
	<td><?php 
	$result=mysqli_query($db,"SELECT * from orders where customerid=$cust");
	while($row=mysqli_fetch_array($result))
	{
		$order=$row{'id'};
		$r=mysqli_query($db,"SELECT bookid from order_p where orderid=$order");
		while($r2=mysqli_fetch_array($r))
			echo $r2{'bookid'}.",";
	}



	?>
	</td>
	</tr>
	<?php $s++;}?>
</table>
</body>
</html>