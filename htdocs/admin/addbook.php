<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Book</title>
<style>
#full{
			margin-top:10%;
			width:40%;
			margin-left:30%;
			background-color:#ffffff;
			color:black;
			margin-bottom: 10%;
		}

		.header{
			height:10%;
			text-align:center;
			padding:4%;
			background-color:#595959;
			color:white;

		}

		#form{
			padding:5%;
			text-align:left;
			font-size:24px;
		}
		#input{
			padding:2%;
			width:93%;
		}

		.btn{
			width:30%;
			margin:auto;
			padding:3%;
			background-color:#99cc00;
			color:white;
			margin-top:8%;
			border:none;
			font-size:18px;
			margin-bottom:5%;

		}
</style>
</head>
<body style="background-image:url('/img/back7.jpg')">
<div id="full">
	<div class="header">
		<h2>ADD BOOK</h2>
	</div>
	
	<form method="post" action="addbook.php" id="form">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Title*</label>
			<input type="text" name="title" id="input">
		</div><br>
		<div class="input-group">
			<label>Author*</label>
			<input type="text" name="author" id="input">
		</div><br>
		<div class="input-group">
			<label>Price*</label>
			<input type="text" name="price" id="input">
		</div><br>
		<div class="input-group">
			<label>Publication*</label>
			<input type="text" name="publication" id="input">
		</div><br>
		<div class="input-group">
			<label>Genre*</label>
			<input type="text" name="genre" id="input">
		</div><br>
		<div class="input-group">
			<label>Stock*</label>
			<input type="text" name="stock" id="input">
		</div><br>
		<div class="input-group">
			<label>ISBN*</label>
			<input type="text" name="isbn" id="input">
		</div><br>
		<div class="input-group">
			<label>Quotes*</label>
			<input type="text" name="quotes" id="input">
		</div>
		<div class="input-group">
			<center><button type="submit" class="btn" name="add_book" onclick="myFunction()"><span>ADD BOOK</span></button></center>
		</div>
	</form>



	
				
</div>
</body>
</html>




<script>
function myFunction() {
    alert("Book Added Successfully");
}
</script>