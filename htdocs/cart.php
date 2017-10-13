<?php
session_start();

$host="localhost";
$user="root";
$password="";


$db=mysqli_connect($host,$user,$password);
mysqli_select_db($db,"miniproject");

$customerid=$_SESSION['customerid'];
//$customerid= $_SESSION['customerid'];
$s=0;

if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }


?>

<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Bubbler+One|Tangerine" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister|Syncopate" rel="stylesheet">
<style>
#navi{
		background-color: #000000;
		overflow:hidden !important;
		list-style-type: none;
		color:#ffffff;
		margin:0;
		padding: 5px !important;
	}

	#navi1{
		float:right;
        padding:5px !important;
	}

	#navi2{
		color:#ffffff;
		display:block;
		text-decoration: none;
        padding-left:5px !important;
        padding-right:5px !important;
	}
   
    #bookish{
        float:left;
        padding:5px;
        margin-left:10px;
    }
	#navi1:hover{
		    background-color: #cc0000;
	}
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    margin-bottom:100px;
    padding-bottom:100px;
    left: 0;
    top: 0;
   padding-bottom:10%;
    width: 100%; /* Full width */
   height:100% !important; /* Full height */
    overflow-y: auto; /* Enable scroll if needed */
    background-color:  #404040 ; /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */

.modal-content {
    position: relative;
    background-color:  #1a1a1a !important;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
    height:700px ;
    
    overflow-y: auto;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #666666;
    color: white;
}



#mbtn1{
	
	width:100%;
	text-align:center;
	padding:4%;
	background-color: #990099;
	 border: none;
	 text-decoration: none;
	 display: inline-block;
	 color:white;
	 margin-top:2%;
	 margin-bottom: 2%;
}
.modal-footer {
    padding: 2px 16px;
    background-color: #1a1a1a;
    color: white;
    width:50%;
    margin:auto;

}

#y{
		text-align:center;
		margin-left:7%;
		margin-right:2%;
		color:white;

		border-color: #8c8c8c;
		border-collapse: collapse;
		
	}
	#r{
		padding-top:1%;
		padding-bottom:1%;
		border: 1px solid #262626 !important;
        text-align:center;

		
	}
#myBtn{
    background-color:#000000;
    
    border:none;

}

#myBtn:hover{
    background-color:#cc0000;
}



</style>
</head>
<body>
<ul id="navi"">
    <li id="bookish" style="float:left;font-family: 'Syncopate', sans-serif;"><a href="home.php" style="text-decoration: none;color:white" >BOOK-ISH.</a></li>
    <li id="navi1"><a href="index.php?logout='1'" id="navi2">Logout</a></li>
	<li id="navi1"><button id="myBtn" style="color:white">Cart</button></li>
	<li id="navi1"><a href="myprofile.php" id="navi2">My Profile</a></li>
</ul>

<!-- Trigger/Open The Modal -->
<!--<button id="myBtn">Open Modal</button> -->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h1 style="text-align:center;font-family: 'Tangerine', cursive;">Your Cart</h1>
    </div>
    <?php  $results=mysqli_query($db,"select b.link,b.title,b.price,b.stock, c.id,ci.quantity,ci.bookid from book b,cart c,cartitems ci where c.customerid='$customerid' and ci.bookid=b.id and ci.cartid=c.id");
         if(mysqli_num_rows($results)==0)
            echo "<h3 style='color:white;text-align:center;padding-top:20%; font-family: 'Tangerine',cursive ;''>Uh-oh!!<br><br>Cart is empty...</h3>";
        else
        {
            ?>




    
    <div class="modal-body">
    <table id="y">
    	<tr style="background-color:#4d4d4d;">
    		<th id="r">S.no</th>
    		<th id="r">Cover</th>
    		<th id="r">Title</th>
    		<th id="r">Quantity</th>
    		<th id="r">Price</th>
            <th id="r">Options</th>
    	</tr>
    	<?php 
    	
    	 while($rows=mysqli_fetch_array($results)) 
    	 {
			$s++;

		?>
			<tr>
				<td id="r" style="width:50px;"><?php echo $s ?></td>
				<td id="r" style="width:90px; height:110px;"><img style="width:100%;height:100%" src="<?php echo $rows{'link'}?>"</td>
				<td id="r" style="width:300px;"><?php echo $rows{"title"}; ?></td>
				<td id="r"><?php echo $rows{"quantity"}; ?></td>
				<td id="r" style="width:150px;"><?php echo $rows{'price'}; ?></td>
                <td id="r"><form method="post" action="todel.php"><input type="hidden" name="todel" value="<?php echo $rows{'bookid'};?>"><input type="hidden" name="cartid" value="<?php echo $rows{'id'};?>"><input type="hidden" name="oldpage" value="<?php echo $_SERVER['REQUEST_URI'] ?>"><input type="submit" value="Delete" name="del"  style="margin-left:10px;margin-right:10px;background-color:red;border: none;padding:5px;color:white;text-decoration: none;"></form></td>
			</tr>;

		<?php
        $cartid=$rows{'id'};
		
    }
    	?>
<tr><td colspan="6" style="height:5%;background-color:#99cc00;color:white;padding:2%;">Amount:<?php $result=mysqli_query($db,"SELECT sum(b.price*ci.quantity) AS value_sum from cartitems ci,book b where ci.cartid=$cartid and ci.bookid=b.id");$row=mysqli_fetch_array($result);echo "   ".$row['value_sum'];?></td></tr>
    </table> 
    </div>






    <div class="modal-footer">

      <form method="post" action="showorder.php"><center ><input type="hidden" name="cartid" style="width:100%;" value="<?php echo $cartid; ?>"><button type="submit" name="makeorder" id="mbtn1" >BUY NOW</button></center></form>
      <?php
    }
    ?>
    </div>
  </div>

</div>


<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>

