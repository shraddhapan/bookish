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

if (isset($_POST['addtocart']))
	{
			
			$query=mysqli_query($db,"SELECT * from cart where customerid=$customerid;");
			$row=mysqli_fetch_array($query);

			$cartid=$row{'id'};
			$quantity= mysqli_real_escape_string($db, $_POST['quantity']);
			$bookid=mysqli_real_escape_string($db, $_POST['bookid']);

			if($quantity==0)
				$quantity=1;
			
			$too=mysqli_query($db,"SELECT * from cartitems where cartid=$cartid and bookid=$bookid");
			if(mysqli_num_rows($too)==0)
				mysqli_query($db,"INSERT INTO cartitems(cartid,bookid,quantity) values ('$cartid','$bookid','$quantity')");
			
			
			header('location: home.php');
	}

?>