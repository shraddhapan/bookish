
<?php 
	session_start(); 

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
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="topnav" id="myTopnav">
  <a href="#home">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#aboutus">About Us</a>
  
  <div class="dropdown" style="float:right">
   
  <button class="dropbtn"><?php  if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p></button>
  <div class="dropdown-content">
    <a href="#"><p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?></a>
  </div>
</div>
  
	  
</div>
	<form class="form-wrapper cf">
  	<input type="text" placeholder="Search your book here..." required>
	  <button type="submit">Search</button>
</form>
	

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		
			
	</div>
		
</body>
</html>