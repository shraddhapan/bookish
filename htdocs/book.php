<?php
 include('cart.php');
//session_start();

$host="localhost";
$user="root";
$password="";

$db=mysqli_connect($host,$user,$password);
mysqli_select_db($db,"miniproject");

//$bookid=$_SESSION["bookid"];
// $bookid;

$customerid=$_SESSION['customerid'];

$url=$_SERVER['REQUEST_URI'];
$query= parse_url($url, PHP_URL_QUERY);
parse_str($query);

$result=mysqli_query($db,"select * from book where id='$id' ");  $row=mysqli_fetch_array($result);




?>

<html>
	<head>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
		    // Check Radio-box
		    $(".rating input:radio").attr("checked", false);

		    $('.rating input').click(function () {
		        $(".rating span").removeClass('checked');
		        $(this).parent().addClass('checked');
		    });

		    $('input:radio').change(
		      function(){
		        var userRating = this.value;
		        
		        location.href=location.href + "&rate="+userRating;
		    }); 
		});
		
		</script>

		  <?php 
			if(isset($_GET["rate"])) 
			{
				
				$rite=mysqli_query($db,"select * from hisrate where custom_id=$customerid and book_id=$id");
				if(mysqli_num_rows($rite)==0)
					{
					mysqli_query($db,"insert into hisrate(custom_id,book_id) values ($customerid,$id) "); 
			   		//mysqli_query($db,"UPDATE book SET user_rating = $rate where id=$id")  ;
			   		$d=mysqli_query($db,"SELECT count(custom_id) as nos from hisrate where book_id=$id");
					$users=mysqli_fetch_array($d);
					$us=$users{'nos'};
					$us++;
					$rate=$_GET["rate"];
					
					mysqli_query($db,"update book set user_rating=(user_rating+$rate)/$us where id=$id");


			   	}

			   	else
			   	{
			   		?>
			   		<script>
			   		alert("You have already rated");
			   		</script>

			   		<?php

			   	}

					
			}

		?>
		<style>

		.rating {
		    float:left;
		    width:300px;
		}
		.rating span { float:right; position:relative; }
		.rating span input {
		    position:absolute;
		    top:0px;
		    left:0px;
		    opacity:0;
		}
		.rating span label {
		    display:inline-block;
		    width:50px;
		    height:50px;
		   
		   
		    background-image:url("/img/blankstar.png");
		    
		}
		.rating span:hover ~ span label,
		.rating span:hover label,
		.rating span.checked label,
		.rating span.checked ~ span label {
		    background-image: url("/img/fullstar.png");
		    color:#000000;
		   
		}

		[type='radio'] {
		display: none; 
		}






		#table{
			
			
			padding-top:5%;
			padding-bottom:5%;
			margin-bottom:8%;
			font-size: 18;
			margin-left: 15%;
			width:70%;
			background-color: #ffffff;
			padding-left:9%;
		}

        #t01{
        	padding:10px;
        	margin-left:20%;
        	padding-left:10%;
        	color:black;

        }

        #t02{
        	padding:3px;
        	color:black;
        }


			

	#bookone{
		padding-top:10px;
		
		margin-left:150px;
		margin-right: 150px;
		padding-left:60px;
		padding-right:60px;
		background-color: #ffffff;
		font-size: 17;
		color:#000000;

		
	}

	body{
    height: 100%;
    width:100%;
    background-color: #e6e6e6;
}

	#bg1{
		margin-top:1%;
		background-clip: padding-box;
		background-attachment: fixed;
		background-position: top;
		background-repeat: no-repeat;
		background-image: url("<?php echo $row{"link"}; ?>");
		
		width:100%;
		height: 400px;
		background-size:100%;

	}
	#bg2{
		background-clip: padding-box;
		background-attachment: fixed;
		background-position: bottom;
		background-repeat: no-repeat;
		background-image: url("<?php echo $row{"link"}; ?>");
		width:100%;
		height: 400px;
		background-size:70%;

	}
	
	#but1{
		width:20%;
		text-align:center;
		padding:2%;
		margin-bottom:5%;
		margin-left:30%;
		background-color: #99cc00;
		color:white;
		border: white;
	}

	#but2{
		width:20%;
		text-align:center;
		padding:2%;
		margin-bottom:5%;
		margin-left:40%;
		background-color: #ffcc00;
		color:white;
		border: white;

	}

	#quant{
		margin-left:40%;
		width:16%;
		padding:2%;
		background-color: #99cc00;
		color:white;

	}

		</style>
	
	
	
	
	</head>

	<body>
	
		
		<div id="bookone">
			<div style="text-align:center; padding:1%;"><?php  echo "<h1><i>", $row{"title"} ,"</h1>",$row{"author"},"</i><br><br>" ?></div>
			<div id="bg1"></div>
			<div style="padding-bottom:10%; padding-top:10%; margin-left:7%;"><?php  echo  $row{'quotes'} ; ?>

			<br><br>

			<!-- for stars............................................................................................ -->
			<ul style="margin-left:5%; ">
				<li style="float:left; width:30%; list-style-type:none;padding-left:1%;"><b>Critic rating : </b></li>
				<li style="float:left; width:30%; list-style-type:none; padding-left:2%;"><b>Users rating :</b></li>
				<li style="float:left; width:35%; list-style-type:none; padding-left:2%;"><b>Your  rating :</b></li>
			</ul>
			<ul>
				<li style="float:left; padding:4%; padding-top:0;list-style-type:none;margin-left:-7%; ">

					<?php
				    for($x=1;$x<=$row{"critic_rating"};$x++) {
				        echo '<img src="/img/fullstar.png" />';
				    }
				    if (strpos($row{"critic_rating"},'.')) {
				        echo '<img style="width:50px; height:50px;" src="/img/halfstar.png" />';
				        $x++;
				    }
				    while ($x<=5) {
				        echo '<img src="/img/blankstar.png" />';
				        $x++;
				    }
					?>
				</li>
				<li style="float:left; padding:4%;padding-top: 0; list-style-type:none;">
					<?php
				    for($x=1;$x<=$row{"user_rating"};$x++) {
				        echo '<img src="/img/fullstar.png" />';
				    }
				    if (strpos($row{"user_rating"},'.')) {
				        echo '<img style="width:50px; height:50px;" src="/img/halfstar.png" />';
				        $x++;
				    }
				    while ($x<=5) {
				        echo '<img style="width:50px; height:50px;" src="/img/blankstar.png" />';
				        $x++;
				    }
					?>
				</li>
				<li style="float:left; padding-top:0%;padding-left:0%; list-style-type:none;" class="rating">
					 <span><input type="radio" name="rating" id="str5" value="5" display="none"><label for="str5"></label></span>
				    <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
				    <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
				    <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
				    <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
				</li>
			</ul>

			<!-- stars done....................................................................................................... -->





				
				
				
				<br><br>
			</div>
			<div id="bg2"></div>

			<div style="background-color:#262626;color:#ffffff;margin-top:5%;margin-bottom:7%;">
			<br><br>
			<div style="text-align:center; border-radius:10px;"><h3>BOOK DETAILS</h3></div><br>
				<table id="table">

					<tr id="t01">
						<td style="text-align:center;"><i><b>Name:</b></i></td>
						<td ><?php echo $row{"title"} ?></td>
					</tr>
					<tr id="t02">
						<td style="text-align:center;"><i><b>Author:</b></i></td>
						<td><?php echo $row{"author"} ?></td>
					</tr>
					<tr id="t01">
						<td style="text-align:center;"><i><b>Publication:</b></i></td>
						<td><?php echo $row{"publication"} ?></td>
					</tr>
					<tr id="t02">
						<td style="text-align:center;"><i><b>ISBN:</i></b></td>
						<td><?php echo $row{"isbn"} ?></td>
					</tr>
					<tr id="t01">
						<td style="text-align:center;"><i><b>Genre:</b></i></td>
						<td><?php echo $row{"genre"} ?></td>
					</tr>
					<tr id="t02">
						<td style="text-align:center;"><b><i>Price:</i></b></td>
						<td ><?php echo $row{"price"},"/-" ?></td>
					</tr>
					
				</table>

			<br><br>
			</div>
			
			

			<form action="addtocart.php" method="post" ><p style="margin-left:40%">QUANTITY:<input type="number"  value = '1' name="quantity" min="1" max="<?php echo $row{'stock'} ;?>" style="width:70px; "></p><input type="hidden" name="bookid" value="<?php echo $row{'id'}; ?>"><button type="submit" name="addtocart" id="but2" >ADD TO CART</button></form>


		</div>
		</body>
		</html>

