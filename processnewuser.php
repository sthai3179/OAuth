<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db_connect.php";

$new_username = $_GET['username'];
$new_password1 = $_GET['password1'];
$new_password2 = $_GET['password2'];

echo "<h2>Trying to add a new user " . $new_username . "password = " . $new_password1 . " and " . $new_password2 . "</h2>";

if($new_password1 != $new_password2){
	echo "The passwords do not match. Try again";
	exit;
}

preg_match('/[0-9]+/', $new_password1, $matches);
if(sizeof($matches) == 0){
	echo "The password must have at least one digit<br>";
	exit;
}

preg_match('/[!@#$%^&*()]+/', $new_password1, $matches);
if(sizeof($matches) == 0){
	echo "The password must have at least one special character like !@#$%^&*()<br>";
	exit;
}

echo "length = " . strlen($new_password1) ;

if(strlen($new_password1 )< 8){
	echo "The password is too short, at least 8 characters";
	exit;
}


//check if user already exists
$sql = "SELECT * FROM users where username = '$new_username'";
$result = $mysqli->query($sql) or die(mysqli_error($mysqli));

if($result -> num_rows > 0){
	//oops. someone is already using that name
	echo "The username " . new_username . " already exists. Can't user the same username";
	exit;
}

//insert a new user
$sql = "INSERT INTO users (id, username, password) VALUES (null, '$new_username', '$new_password1')";

$result = $mysqli->query($sql) or die(mysqli_error($mysqli));

if($result){
	echo "Registration success";
}
else{
	echo "Something went wrong. Not registered";
}

echo "<a href= 'index.php'>Return to main page</a>";
?>