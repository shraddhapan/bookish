<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<style>
	body{
  
  margin-left:32%;
  background-image: url("/img/back8.jpg");
  background-repeat: no-repeat;
  background-size: 100%;

}


.full{
  margin-top:16%;
  width:40%;
  padding-left:7%;
  background-color: #ffffff;
  padding-right:7%;
  padding-top:2%;
  padding-bottom:2%;
}

.header{
  padding-top:3%;
  background-color:#666666;
  padding-left:5%;
  padding-bottom:1%;
  margin-bottom:10%;
}

.input-group{
  padding-top:5%;
  padding-left:5%;

}

.in{
  border:none;
  width:90%;
  padding-top:5%;
  border-bottom: 1px solid #666666;
}

.btn{
  margin-left:30%;
  border:none;
  padding:3%;
  padding-left:9%;
  padding-right:9%;
}
	</style>
</head>
<body>
<div class="full">
	<div class="header">
		<h2>Login</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label><br>
			<input type="text" class="in" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label><br>
			<input type="password" class="in" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user"><span>Login</span></button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
		<p>
			<a href="/admin/login.php">Admin Login</a>
		</p>
	</form>
</div>
</body>
</html>