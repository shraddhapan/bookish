<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	






<style>
	
/* The message box is shown when the user clicks on the password field */
#message {
    display:none;
    background: #f1f1f1;
    color: #000;
    position: relative;
    padding: 20px;
    margin-top: 10px;
}

#message p {
    padding: 10px 35px;
    font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
    color: green;
}

.valid:before {
    position: relative;
    left: -35px;
    content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
    color: red;
}

.invalid:before {
    position: relative;
    left: -35px;
    content: "✖";
}



body{
  
  margin-left:32%;
  background-image: url("/img/back8.jpg");
  background-repeat: no-repeat;
  background-size: 100%;

}


.full{
  margin-top:11%;
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











	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
</head>
<body>
<div class="full">
	<div class="header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="server.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username*</label><br>
			<input type="text" name="username" class="in" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email*</label><br>
			<input type="email" name="email" class="in" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label for="password_1">Password*</label><br>
			<input type="password" class="in" name="password_1"  
			 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
		</div>
		<div class="input-group">
			<label>Confirm password</label><br>
			<input type="password" class="in" name="password_2">
		</div>
		<div class="input-group">
			<label for ="mobileno">Mobile No*</label><br>
			<input type="mobileno" class="in"  name="mobileno" value="<?php echo $mobileno?>"
       pattern="(?=.*[0-9]).{10,}" title="Must contain at least 10 digits" required>
		</div><p>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user"><span>Register</span></button>
		</div>
		<p style="text-align:center">
			Already a member? <a href="login.php">Sign in</a>
		</p>
    <p style="text-align:center">
      <a href="/admin/login.php">Admin login</a>
    </p>
</form>



<div id="message">
  <h3>Password must contain the following:</h3>
	<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
	<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
	<p id="number" class="invalid">A <b>number</b></p>
	<p id="length" class="invalid">Minimum <b>8 characters</b></p>
  <p id="length_m" class="invalid">Minimum <b>10 digits</b></p>
</div>
				
<script>
var myMobile = document.getElementById("mobileno");
var myInput = document.getElementById("password_1");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var length_m = document.getElementById("length_m");

// When the user clicks on the password field, show the message box
myMobile.onfocus = function(){
  document.getElementById("message").style.display = "block";
}

myMobile.onblur = function() {
    document.getElementById("message").style.display = "none";
}

myMobile.onkeyup = function() {
  // Validate 10 digits
  var digits = /[0-9]/g;
  if(myMobile.value.match(digits)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }


  // Validate length
  if(myMobile.value.length_m >= 10 && myMobile.value.length_m <=12) {
    length_m.classList.remove("invalid");
    length_m.classList.add("valid");
  } else {
    length_m.classList.remove("valid");
    length_m.classList.add("invalid");
  }
}




myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>





</div>
</body>
</html>