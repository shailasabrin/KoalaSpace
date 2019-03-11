<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php'; 
require 'includes/form_handlers/login_handler.php';

?>

<html>
<head>
	<title>Welcome to BeeBuzz!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
</head>
<body>
	<div class = "wrapper">

		<div class= "login_box">
			<div class ="login_header">
			<h1> Koala Space</h1>
			<h3>Login Or Sign Up Below!</h3>
		</div>
	
	<div class= "first">
		<form action = "register.php" method="POST">
		<input type="email" name="log_email" placeholder="Email Address" value ="<?php 
		if(isset($_SESSION['log_email'])){
			echo $_SESSION['log_email'];
		}
		?>" required>
		<br>
		<input type="password" name="log_password" placeholder="Password">
		<br>
		<input type ="submit" name ="login_button" value = "Login">
		<br> 
		<?php
		 if(in_array("Email or password was incorrect <br>" , $error_array)) echo "Email or password was incorrect <br>" ?>
		<a href="#" id="signup" class="signup"> Need an account? Register here!</a>	
		
	</form>
		
	</div>	


	<div class="second">
		<form action ="register.php" method ="POST">
			<input type ="text" name = "reg_fname" placeholder="First Name" value ="<?php 
			if(isset($_SESSION['reg_fname'])){
				echo $_SESSION['reg_fname'];
			}
			?>" required>
			<br>
			<?php if(in_array("Your first name must be between 2 to 25 characters<br>", $error_array)) echo "Your first name must be between 2 to 25 characters<br>"; ?> 


			<input type ="text" name = "reg_lname" placeholder="Last Name" value ="<?php 
			if(isset($_SESSION['reg_lname'])){
				echo $_SESSION['reg_lname'];
			}
			?>" required>
			<br>
			<?php if(in_array("Your last name must be between 2 to 25 characters<br>", $error_array)) echo "Your last name must be between 2 to 25 characters<br> "; ?> 



			<input type ="email" name = "reg_email" placeholder="Email" value ="<?php 
			if(isset($_SESSION['reg_email'])){
				echo $_SESSION['reg_email'];
			}
			?>"  required>
			<br>

			<input type ="email" name = "reg_email2" placeholder="Confirm Email" value ="<?php 
			if(isset($_SESSION['reg_email2'])){
				echo $_SESSION['reg_email2'];
			}
			?>"  required>
			<br>
			<?php if(in_array("Email already in use <br>", $error_array)) echo "Email already in use <br>";  
			else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";  
			else if(in_array("Emails don't match <br>", $error_array)) echo "Emails don't match <br>"; ?> 

			<input type ="password" name = "reg_password" placeholder="Password" required>
			<br>
			<input type ="password" name = "reg_password2" placeholder="Confirm Password" required>
			<br>
			<?php if(in_array(" Passwords do not match! <br>", $error_array)) echo " Passwords do not match! <br>";  
			else if(in_array("Your password can only contain english characters and numbers<br>", $error_array)) echo "Your password can only contain english characters and numbers<br>";  
			else if(in_array("Your password must be between 5 to 30 characters<br>", $error_array)) echo "Your password must be between 5 to 30 characters<br>"; ?> 

			<input type ="submit" name ="register_button" value = "Register">
			<br>


			<?php if(in_array("<span style = 'color: #BA3B46; font weight: bold;'> You are all set! Go ahead and login to BeeBuzz!</span>", $error_array)) echo "<span style = 'color: #BA3B46; font weight: bold;'> You are all set! Go ahead and login to BeeBuzz!</span><br>"; ?>
			<a href="#" id="signin" class="signin">Already have an account? Sign in here! </a>	

	</form>
		
	</div>
	
	</div>
    </div>

</body>
</html>