<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>DELETE</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>DELETE</h2>
	</div>
	
	<form method="post" action="delete.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Enter ISBN</label>
			<input type="text" name="delete_isbn" >
		</div>
		<div class="input-group">
			<center><button type="submit" class="btn" name="deleteisbn"><span>Delete</span></button></center>
		</div>
	</form>

</body>
</html>