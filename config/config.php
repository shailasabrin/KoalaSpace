<?php
ob_start();// turns on output buffering
session_start();

$timezone = date_default_timezone_set("Canada/Pacific"); 

$con = mysqli_connect("localhost", "root", "", "social"); // Connection Variable

// failed to connect with database
if (mysqli_connect_errno()){
	echo "Failed to connect: " . mysqli_connect_errno();
} 
?> 