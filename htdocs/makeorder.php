<?php

session_start();

// variable declaration
$id = "";
$username = "";
$email    = "";
$mobileno = "";
$customerid=$_SESSION['customerid'];
//$customerid=1;

$db = mysqli_connect('localhost', 'root', '', 'miniproject');

if (isset($_POST['makeorder']))
{
		$cartid = mysqli_real_escape_string($db,$_POST['cartid']);
		$area=mysqli_real_escape_string($db,$_POST['area']);
		$address=mysqli_real_escape_string($db,$_POST['address']);


		

		$query=mysqli_query($db,"INSERT INTO orders(date,amount,customerid) values (CURDATE(),'0',$customerid)");
		
		

		$orderid= mysqli_insert_id($db);
		

		$query=mysqli_query($db,"SELECT * from cartitems where cartid='$cartid'");
		while($row=mysqli_fetch_array($query))
		{
			$bookid=$row{'bookid'};
			$quantity=$row{'quantity'};
			$r1=mysqli_query($db,"INSERT into order_p(orderid,bookid,quantity) values('$orderid','$bookid','$quantity')");
		
		

		}


		$r2=mysqli_query($db,"DELETE from cartitems where cartid='$cartid'");

		

		
		$r4=mysqli_query($db,"update orders set area='$area',address='$address' where id=$orderid");


		$r3=mysqli_query($db,"INSERT INTO placed(customerid,orderid) values ($customerid,$orderid)");
		
		
		$r5=mysqli_query($db,"UPDATE orders set amount=(SELECT sum(b.price*op.quantity) from order_p op,book b where op.orderid='$orderid' and op.bookid=b.id) where id='$orderid'");
		
		header("location: checkout.php");
}

?>