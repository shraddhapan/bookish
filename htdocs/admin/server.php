<?php 

	session_start();
	ini_set('display_errors', 0);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	// variable declaration

	$errors = array(); 
	$_SESSION['success'] = "";
	$results = 0;

	$first_pos = 0;
	$RESULTS_LIMIT=100;
	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'miniproject');

?>

	<!DOCTYPE html>
	<html>
	<head>
		<style>

		#table{
			background-color:white;
			width:94%;
			padding:2%;
			margin:3%;
			margin-top:0;
			border: 1px solid #737373;
			border-collapse: collapse;


		}

		#th{
			width:16%;
			padding:3%;
			text-align:center;
			border-collapse: collapse;

			border: 1px solid #737373;
			color:white;
			background-color:#404040;
		}

		#td{
			width:16%;
			padding:1%;
			text-align:center;
			border: 1px solid #737373;
			border-collapse: collapse;

			}
		</style>

	</head>
	<body>







<?php
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");           
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			
			$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
			$queryid = mysqli_query($db,"SELECT id FROM admin WHERE username='$username' AND password='$password'");
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) > 0) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				 while($row = mysqli_fetch_array($queryid))
				 
				$_SESSION['session_customerid'] = $row['id'];
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}



	if (isset($_POST['add_book']))
	{
		$title = mysqli_real_escape_string($db, $_POST['title']);
		$price = mysqli_real_escape_string($db, $_POST['price']);
		$author = mysqli_real_escape_string($db, $_POST['author']) ;
		$publication = mysqli_real_escape_string($db, $_POST['publication']);
		$stock = mysqli_real_escape_string($db, $_POST['stock']);
		$isbn = mysqli_real_escape_string($db, $_POST['isbn']);
		$genre = mysqli_real_escape_string($db, $_POST['genre']);
		$quotes = mysqli_real_escape_string($db, $_POST['quotes']);
		$summary = mysqli_real_escape_string($db, $_POST['summary']);

		if (empty($title)) {
			array_push($errors, "Title is required");
		}

		if (empty($price)) {
			array_push($errors, "Price is required");
		}
		if (empty($author)) {
			array_push($errors, "Author is required");
		}
		if (empty($isbn)) {
			array_push($errors, "ISBN is required");
		}
		if (empty($stock)) {
			array_push($errors, "Stock is required");
		}
		if (empty($genre)) {
			array_push($errors, "Genre is required");
		}
		if (empty($publication)) {
			array_push($errors, "Publication is required");
		}
		if (empty($quotes)) {
			array_push($errors, "Quotes is required");
		}
		if (empty($summary)) {
			array_push($errors, "Summary is required");
		}




		if (count($errors) == 0) {
			
			$query = "INSERT into book(title,price,author,isbn,stock,genre,publication,quotes,summary) values('$title','$price','$author','$isbn','$stock','$genre','$publication','$quotes','$summary')";
			mysqli_query($db, $query);
			//$_SESSION['success'] = "Book Added Sucessfully";           
			header('location: addbook.php');                         

		
		}															
	}




	if (isset($_POST['updatestock']))
	{
		$update_isbn = mysqli_real_escape_string($db,$_POST['update_isbn']);
		$update_stock = mysqli_real_escape_string($db,$_POST['update_stock']);
		$update_price = mysqli_real_escape_string($db,$_POST['update_price']);

		if(empty($update_isbn))
		{
			array_push($errors, "ISBN is required");
		}
		if (empty($update_stock)) {
			array_push($errors, "Stock is required");
		}
		if(empty($update_price))
		{
			array_push($errors, "Price is required");
		}

		if(count($errors) == 0)
		{
			$query = "UPDATE book set price = '$update_price', stock = '$update_stock' where isbn = '$update_isbn'";
			mysqli_query($db,$query) ;
			header('location: update.php');
		}


	}






																	


	if (isset($_POST['deleteisbn'])) 
	{									
		$delete_isbn = mysqli_real_escape_string($db, $_POST['delete_isbn']);
		if (empty($delete_isbn)) {									 
			array_push($errors, "Field Cannot be Empty");
		}

		if (count($errors) == 0)
		{

				$deletequery  = "UPDATE book SET stock = '$first_pos' where isbn = '$delete_isbn' ";

				mysqli_query($db,$deletequery);						
				//$_SESSION['success'] = "Book Deleted Successfully";
				header('location: delete.php');


	}
	}



	if(isset($_POST['searchterm']))
	{
		$search_term = mysqli_real_escape_string($db,$_POST['search_term']);



		if(empty($search_term))
		{
			array_push($errors,"Field Cannot be Empty");
			
			
		}

		if(count($errors)==0)										
		{

		$sql_query = mysqli_query($db,"SELECT * FROM book WHERE MATCH(title,author,genre,publication,isbn) AGAINST '$search_term'");

	    if($results = mysqli_num_rows($sql_query) != 0)
	            {
	                $sql =  "SELECT * FROM book WHERE MATCH(title,author,genre,publication,isbn) AGAINST('$search_term')";
	                  $sql_result_query = mysqli_query($db,$sql);  
	                  
	            }
	            
	    else
	            {
	                  $sql = "SELECT * FROM book WHERE (title LIKE '%".mysqli_real_escape_string($db,$search_term)."%' OR author LIKE '%".$search_term."%' OR genre LIKE '%".$search_term."%' OR publication LIKE '%".$search_term."%' OR isbn LIKE '%".$search_term."%') ";
	                  $sql_query = mysqli_query($db,$sql);
	                  $results = mysqli_num_rows($sql_query);
	               
	                 $sql_result_query = mysqli_query($db,"SELECT * FROM book WHERE (title LIKE '%".$search_term."%' OR author LIKE '%".$search_term."%' OR genre LIKE '%".$search_term."%' OR publication LIKE '%".$search_term."%' OR isbn LIKE '%".$search_term."%' )");
	                 
	            }

 		 /*echo "Title"?>-----------<?php echo "ISBN"; ?>*/
 ?>
 		 
 	<div id="table" style="width:90%;padding-top:1%;padding-bottom:1%;margin-bottom:0;background-color:black;color:white;text-align:center;"><h1>Search Results</h1></div>
 	<table id="table">
 		<tr id="tr">
 			<th id="th">Title</th>
 			<th id="th">ISBN</th>
 			<th id="th">Author</th>
 			<th id="th">Publication</th>
 			<th id="th">Price</th>
 			<th id="th">Stock</th>
 		</tr>


<?php
  
    while($row = mysqli_fetch_array($sql_result_query))
    {
    
	  if($row['stock']!=0)
		{
 		
?>

	<tr id="tr">
		<td id="td"><?php echo $row{'title'} ;?></td>
		<td id="td"><?php echo $row{'isbn'}?></td>
		<td id="td"><?php echo $row{'author'}?></td>
		<td id="td"><?php echo $row{'publication'}?></td>
		<td id="td" style="width:5%"><?php echo $row{'price'}?></td>
		<td id="td" style="width:5%"><?php echo $row{'stock'}?></td>

	</tr>

<?php
		}
	}
	?>
	</table>


	<?php

if($results = mysqli_num_rows($sql_query) == 0)
{
	echo "No results Found";
}
}
}
?>

</body>
</html>