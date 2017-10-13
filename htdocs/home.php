<?php
include('cart.php');
//session_start();

if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}





$host="localhost";
$user="root";
$password="";


$db=mysqli_connect($host,$user,$password);
mysqli_select_db($db,"miniproject");

$customerid=$_SESSION['customerid'];
$result=mysqli_query($db,"SELECT * from cart where customerid='$customerid'");
$row=mysqli_fetch_array($result);
$orderid=$row{'id'};
$s=0;
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Bubbler+One|Tangerine" rel="stylesheet">
		<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
	
	#hero{
		background-color:#ffffff;
		width: 100%;
		height: 100%;
		
	}

	
	body{
		height:100%;
	}

	#slide1{
		float:left;
		height:270px;
		width:230px;
		
		margin: 0;

		
	}
	img{
		width:100%;
		height: 100%;
		padding:15px;
		
	}
	
	#slide{
		margin-top: 0;
		padding-top:5px;
		list-style-type:none;

	}

	#search{
		margin-left:150px;
		margin-right: 120px;
		padding-top:30px;
		padding-bottom: 20px;
		color:white;
		

	}

	#search1{
		width:80%;
		padding:1%;
		float:left;
		color:black;
	}

	#one{
		padding-top:20px;
		padding-bottom:20px;
		margin-left:210px;
		margin-right: 200px;
		padding-left:10px;
		padding-right: :10px;
		text-align:center;
		background-color:#ffffff;
		color:#000000;
		font-family: 'Tangerine', cursive;
	}
	#two{
		padding-top:20px;
		padding-bottom: 20px;
		margin-left:210px;
		margin-right: 200px;
		padding-left:10px;
		padding-right:10px;
		text-align:center;
		background-color: #ffffff;
		color:#000000;
			font-family: 'Tangerine', cursive;
	}
	#zero{
		background-color: #404040;
		margin-top:30px;
		
		padding:10px;
		text-align:center;
		color:white;
		font-family: 'Bubbler One', sans-serif;
	}
	#three{
		padding-top:20px;
	
		margin-left:210px;
		margin-right: 200px;
		padding-left:10px;
		padding-right:10px;
		text-align:center;
		background-color:#ffffff;
		color:#000000;
		font-family: 'Tangerine', cursive;
	}
	

	#genre{
		
		width:29%;
		margin:1%;
		margin-left: 2%;
		padding-top:5%;
		padding-bottom:5%;
		float:left;
		background-color:#ffffff;
	}
	#genres{
		padding-top:50px;
		padding-bottom: 3%;
		margin-left:150px;
		margin-right: 150px;
		
		padding-right:10px;
		background-color:#ffffff;
		text-align: center;
		margin-bottom: 0;
		padding-bottom: 20%;
	}
	
</style>
</head>
<body>
<!-- NAVBAR -->
	
	<div id="hero">
<div id="zero">
<form id="search" action="temp2.php" method="GET">
 <p ><h1 style="font-family:'Tangerine', cursive;">What are you looking for today?</h1></p><input type="text" id="search1" name="search_term"><input type="submit" value="Search" style="padding-left:5%;padding-right:5%;padding-top:1%;padding-bottom:1%;color:#000000;"><br><br><br>
 </form>
</div>
 <div id="one">

<!--Bestsellers-->
<h1>Our Bestsellers  </h1>
<div id="myCarousel" class="carousel slide" data-ride="carousel" >

	<!-- Wrapper for slides -->
  <?php 

  $_SESSION["bookid"] = "0";

  $result=mysqli_query($db,"select * from book order by sale desc limit 15");
  //while($row=mysqli_fetch_array($result))
 // {
  ?>
   <div class="carousel-inner">
    <div class="item active">
      <ul id="slide">

      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      
      </ul>
    </div>

    <div class="item">
      <ul id="slide">
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	</ul>
    </div>
   
    <div class="item">
    <ul id="slide">
    	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
    </ul>
      
    </div>
  </div>
 </div>
 </div>

<!-- bestsellers................................................................... -->
<div id="two">
 <?php 

  $result=mysqli_query($db,"select * from book order by critic_rating limit 15");
  
  ?>
<h1>Critic Favourites</h1>
<div id="myCarousel" class="carousel slide" data-ride="carousel" >

	<!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <ul id="slide">

      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>

      </ul>
    </div>

    <div class="item">
      <ul id="slide">
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      </ul>
    </div>

    <div class="item">
    <ul id="slide">
    	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
    </ul>
      
    </div>
  </div>
 </div>
 </div>
<!-- .................................................................. -->
<div id="three">
<!--Bestsellers-->
<h1>Man booker nominees</h1>
<div id="myCarousel" class="carousel slide" data-ride="carousel" >
<?php 

  $result=mysqli_query($db,"select * from book where id>11 and id <30");
  
  ?>
	<!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <ul id="slide">
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      </ul>
    </div>

    <div class="item">
      <ul id="slide">
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
     	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      	<li id="slide1"><?php $row=mysqli_fetch_array($result); echo '<a href = "book.php?id='.$row{'id'}.'" ><img src="' .$row{'link'}.'"></a>' ?></li>
      </ul>
    </div>

   
  </div>
 </div>
 </div>

 <div id="genres">
 <form action="temp2.php" method="GET">
 	<h1 style="font-family:'Tangerine', cursive;">Or Explore by your favourite genre....</h1><br>
 	<ul style="text-align:center;list-style-type:none;">
 		<li ><input type="hidden" ><input id="genre" style="background-color: #00cc66;" type="submit"  name="search_term" value="Mystery"></li>
 		<li ><input type="hidden" ><input id="genre" style="background-color: #00cc99;" type="submit" name="search_term" value="Fiction"></li>
 		<li ><input type="hidden" ><input id="genre" style="background-color: #00cccc;" type="submit"  name="search_term" value="Non-fiction"></li>
 		
 	</ul>
 	<ul style="text-align:center;list-style-type:none;margin-bottom:10px;padding-bottom:-10px;">
 		<li ><input type="hidden"  ><input id="genre" style="background-color: #0099cc;"  name="search_term" type="submit" value="Comics"></li>
 		<li ><input type="hidden"  ><input id="genre" style="background-color: #0066cc;"  name="search_term" type="submit" value="Poetry"></li>
 		<li ><input type="hidden"  ><input id="genre" style="background-color: #0000cc;"  name="search_term" type="submit" value="Classics"></li>
 		
 	</ul>
</form>
 	<br><br>
 </div>


 </div>
 
</body>

</html>
