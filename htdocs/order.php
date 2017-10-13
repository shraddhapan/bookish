<?php
include('cart.php');

//session_start();
$s=0;
$host="localhost";
$user="root";
$password="";


$db=mysqli_connect($host,$user,$password);
mysqli_select_db($db,"miniproject");

$customerid=$_SESSION['customerid'];

$url=$_SERVER['REQUEST_URI'];
$query= parse_url($url, PHP_URL_QUERY);
parse_str($query);


$s=0;
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Bubbler+One|Tangerine" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC|Limelight|Lobster+Two" rel="stylesheet">
	<style>

	#table{
		text-align:center;
		
		width:104%;
		background-color:white;
		border: 1px solid #404040;
		border-collapse: collapse;
		margin-right:0;

	}
	td,th{
		padding-top:1%;
		padding-bottom:1%;
		
	}
	#th{
		padding-top:1%;
		padding-bottom:1%;
		
	}

	img{
		width:100%;
		height:100%;
		
	}
	
	


	/*#hero{
		margin-top:30px;
		margin-left:150px;
		margin-right: 150px;
	}*/
	
	#head{
		padding:2%;
		background-color: #27272b;
		width:100%;
		margin-top:1%;
		color:white;
	}

	#top{
		padding:1%;
		text-align:center;
		background-color:black;
		border: 1px solid #262626;
		color:white;
	}

	#hero{
		background-color:white;
		margin-left:130px;
		margin-right: 130px;
	}

	#deliver{
		padding-top:7%;
		
	}

	#delivery{
		width:100%;
		margin:auto;
		padding:2%;
		background-color:white;
	}

	#address{
		font-size:28px;
		text-align:center;
	}

	#btn{
		border:none;
		width:20%;
		color:white;
		background-color:#ffcc00;
		padding:2%;
		font-size:18px;
	}
	</style>

</head>

<body  >

<?php 
  $result=mysqli_query($db,"select b.link,b.title,op.quantity,b.price,o.id ,o.amount,o.date from orders o,order_p op,book b where o.id=op.orderid and op.bookid=b.id and o.customerid=$customerid and o.id=$orderid ;");
  
 
  $row=mysqli_fetch_array($result);

  $date1=$row{'date'};
  $amount=$row{'amount'};
  ?>


<div id="hero">
	<div id="head">
	<h1 style="text-align:center;font-family: 'Lobster Two', cursive;">Order Summary</h1></div>
	

	<table id="table">
		<tr id="top">
			<th id="th">S.no</th>
			<th id="th">Cover </th>
			<th id="th">Title</th>
			<th id="th">Quantity</th>
			<th id="th">Price</th>
		</tr>

		<?php
		do
		{
			$s++;
			echo '<tr style="border: 1px solid #262626;"><td style="width:50px;border: 1px solid #262626;">'.$s.'</td><td style="width:100px;border: 1px solid #262626; height:130px;"><img src="'.$row{'link'}.'"</td><td style="width:300px;border: 1px solid #262626;">',$row{"title"},'</td><td style="width:75px;border: 1px solid #262626;">'.$row{'quantity'}.'</td><td style="width:200px;border: 1px solid #262626;">'.$row{'price'}.'</td></tr>';
		}while($row=mysqli_fetch_array($result)) ;
		?>

		<tr><td colspan="5" style="padding:2%; text-align:center; font-size:18px;background-color:#99cc00;color:white;">AMOUNT:<?php echo $amount?></td></tr>
		<tr><td colspan="5" >REQUESTED ADDRESS: <?php $d=mysqli_query($db,"select * from orders where id=$orderid");$r=mysqli_fetch_array($d); echo $r{'area'}.",".$r{'address'};?></td></tr>
	</table>
	</div>
	

</body>
</html>