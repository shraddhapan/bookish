<?php 

session_start();

// variable declaration
$id = "";
$username = "";
$email    = "";
$mobileno = "";
$errors = array(); 
$_SESSION['success'] = "";

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'miniproject');

// REGISTER USER
if (isset($_POST['reg_user'])) {
	//alert('<?php echo $username; ');
	// receive all input values from the form


	$id = mysqli_real_escape_string($db,$_POST['id']);
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);	
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$mobileno = mysqli_real_escape_string($db,$_POST['mobileno']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if (empty($mobileno)) { array_push($errors, "Mobile No is required"); }

	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
	$sql=mysqli_query($db,"SELECT FROM customer (mobileno) WHERE mobileno=$mobileno");
 if(mysqli_num_rows($sql)>=1)
   {
    	array_push($errors, "User Exits! You can directly Login");
   }
 else
    {
   if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
		$query = "INSERT INTO customer (username, email, password, mobileno) 
				  VALUES('$username', '$email', '$password','$mobileno')";
		mysqli_query($db, $query);
		$customerid=mysqli_insert_id($db);
		$_SESSION['username'] = $username;
		$_SESSION['customerid'] = $customerid;

		$_SESSION['success'] = "You are now logged in";

		mysqli_query($db,"insert into cart(customerid) values('$customerid')");	
		header('location: home.php');
	}
    }
	// register user if there are no errors in the form
	

}
if (isset($_POST['login_user'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$id 	= mysqli_real_escape_string($db,$_POST['id']);

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0) {
		$password = md5($password);
		$query = "SELECT * FROM customer WHERE username='$username' AND password='$password'";


		$results = mysqli_query($db, $query);
		$row=mysqli_fetch_array($results);

		if (mysqli_num_rows($results) > 0) {
			$_SESSION['username'] = $username;
			$_SESSION['customerid'] = $row{'id'};
			$_SESSION['success'] = "You are now logged in";
			header('location: home.php');
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

?>
