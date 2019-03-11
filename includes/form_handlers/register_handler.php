<?php
//Declaring variables to prevent errors
$fname=""; //first name
$lname=""; //last name
$email =""; // email
$email2 ="";// confirm email
$password =""; //Password
$password2 =""; //Confirm Password
$date ="";  //Signup date
$error_array = array(); //Holds up error messages


if(isset($_POST['register_button'])) {

	// Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); // remove html tags
	$fname = str_replace(' ', '', $fname); // remove spaces
	$fname = ucfirst(strtolower($fname)); // upper case First letter of the name
	$_SESSION['reg_fname']= $fname; //stores first name to session variable

	//Last name
	$lname = strip_tags($_POST['reg_lname']); // remove html tags
	$lname = str_replace(' ', '', $lname); // remove spaces
	$lname = ucfirst(strtolower($lname)); // upper case First letter of the name
	$_SESSION['reg_lname']= $lname; //stores last name to session variable

	//email
	$email = strip_tags($_POST['reg_email']); // remove html tags
	$email = str_replace(' ', '', $email); // remove spaces
	$email = ucfirst(strtolower($email)); // upper case First letter of the email
	$_SESSION['reg_email']= $email; //stores email to session variable

	//confermation email
	$email2 = strip_tags($_POST['reg_email2']); // remove html tags
	$email2 = str_replace(' ', '', $email2); // remove spaces
	$email2 = ucfirst(strtolower($email2)); // upper case First letter of the email
	$_SESSION['reg_email2']= $email2; //stores email2 to session variable

	//Password
	$password = strip_tags($_POST['reg_password']); //remove html tags

	//Confermation Password
	$password2 = strip_tags($_POST['reg_password2']); //remove html tags

	//date
	$date= date("Y-m-d"); // current date

	if($email == $email2){
		//check if the email format is valid?
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		// Check if email really exist
		    $e_check = mysqli_query($con,"SELECT email FROM users WHERE email = '$email'");
		    // count the number of rows returned
		    $num_rows= mysqli_num_rows($e_check);

		    if($num_rows > 0){
		    	array_push($error_array, "Email already in use <br>") ;
		    }
		}
		else{
			array_push($error_array,"Invalid email format<br>");
		}


	}
	else {
		array_push($error_array, "Emails don't match <br>");
	}

	if (strlen($fname) > 25 || strlen($fname) <2){
		array_push($error_array,"Your first name must be between 2 to 25 characters<br>");
	}
	if (strlen($lname) > 25 || strlen($lname) <2){
		array_push($error_array, "Your last name must be between 2 to 25 characters<br>");
	}
	if($password != $password2){
		array_push($error_array, " Passwords do not match! <br>");
	}  
	else{
		if (preg_match('/[^A-Za-z0-9]/', $password)){
			array_push($error_array,"Your password can only contain english characters and numbers<br>");
		}
	}
	if (strlen($password)>30 || strlen($password)< 5 ){
		array_push($error_array, "Your password must be between 5 to 30 characters<br>");
	}

	if(empty($error_array)){
		$password= md5($password);//encrypt password before sending to the database

		// Generate username by concatingFirst name and Last name 
		$username= strtolower($fname."_".$lname);
		$check_username_query= mysqli_query($con,"SELECT username FROM users WHERE username='$username' ");
		$i =0; 
		// if username already exists add number to username
		while(mysqli_num_rows($check_username_query) !=0){
			$i++;
			$username = $username."_".$i;
			$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username' ");
		}

		//profile picture assignment
		$rand = rand(1,2); // Random number between 1 and 2
		if($rand = 1)
		$profile_pic="assets/images/profile_pics/defaults/head_sun_flower.png";
	    else if($rand = 1)
		$profile_pic="assets/images/profile_pics/defaults/head_red.png";

	$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

	array_push($error_array, "<span style = 'color: #BA3B46; font weight: bold;'> You are all set! Go ahead and login to BeeBuzz!</span>");

	// Clear session variable
	$_SESSION['reg_fname'] = "";
	$_SESSION['reg_lname'] = "";
	$_SESSION['reg_email'] = "";
	$_SESSION['reg_email2'] = ""; 

	} 

}

?>