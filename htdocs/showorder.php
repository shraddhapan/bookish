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

$cartid=$_POST['cartid'];
$s=0;

?>

<!DOCTYPE html>
<html>
<head>
<style>
#hero{
	margin:2%;
}
#table{
		text-align:center;
		
		width:100%;
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
	#head{
		padding:2%;
		background-color:#404040;
		color:white;
	}
</style>
</head>
<body >

<?php 
  $result=mysqli_query($db,"select b.link,b.title,ci.quantity,b.price,c.id  from cart c,cartitems ci,book b where c.id=ci.cartid and ci.bookid=b.id and c.customerid=$customerid and c.id=$cartid ;");
  
 
  $row=mysqli_fetch_array($result);

 
  ?>


<div id="hero">
	<div id="head">
	<h1 style="text-align:center;">CART SUMMARY</h1></div>
	

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

		<tr><td colspan="5" style="padding:2%; text-align:center; font-size:18px;background-color:#99cc00;color:white;">AMOUNT:<?php $result=mysqli_query($db,"SELECT sum(b.price*ci.quantity) AS value_sum from cartitems ci,book b where ci.cartid=$cartid and ci.bookid=b.id");$row=mysqli_fetch_array($result);echo "   ".$row['value_sum'];?></td></tr>
	</table>
	</div>
	<div id="deliver">
	<div id="delivery">
	<h1 style="padding:2%;background-color:#404040;color:white;text-align:center"> CASH ON DELIVERY</h1>
	<div id="address">Enter address to be delivered to:<br>
	<form method="post" action="makeorder.php">
		<select Id="myDropdown" style="padding:1%;font-size:22px;" name="area">
		   <option value="Hadapsar">Hadapsar</option>
		   <option value="Wakad">Wakad</option>
		   <option value="Kothrud">Kothrud</option>
		   <option value="Vimannagar">Vimannagar</option>
		   <option value="Bavdhan">Bavdhan</option>
		   <option value="Baner">Baner</option>
		   <option value="Katraj">Katraj</option>
		   <option value="Chinchwad">Chinchwad</option>
		   <option value="Nigdi">Nigdi</option>
		   <option value="Koregaon Park">Koregaon Park</option>
		   <option value="Kalyaninagar">Kalyaninagar</option>
		   <option value="Pimpri">Pimpri</option>
		   <option value="Bhosari">Bhosari</option>
		   <option value="Kharadi">Kharadi</option>
		   <option value="Swargate">Swargate</option>
		</select>

		<input id="txtBox" type="text" value="Street" name="address" style="padding:1%;font-size:22px;width:40%;">
		<script>
		/*
		 $("#myDropdown").change(function () {
		   var selectedValue = $(this).val();
		   
		   

		   $("#txtBox").val($(this).find("option:selected").attr("value"));
		});*/
		</script>

		<br><br>
		<center ><input type="hidden" name="cartid" style="width:100%;" value="<?php echo $cartid; ?>"><button type="submit" name="makeorder" id="mbtn1" >PROCEED TO CHECKOUT</button></center></form>
		
	</div>

	</div>
	</div>

</body>
</html>