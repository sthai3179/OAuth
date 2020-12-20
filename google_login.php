<?php
//turn on error reporting for testing purposes. Delete this lines for production code.
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); //session start

//this link is required to access the google login functionality. 
//It was putthere when you ran composer require google.apiclient
require_once('vendor/autoload.php');

//this data needs to be customized according to the Google
$client_id = '721175639273-logaecdm7f5fv1lag77gcltid485qf4c.apps.googleusercontent.com';
$client_secret = 'xFM0Yu9MCM74Y-wzROG0kOMu';
$redirect_uri = 'http://localhost:8888/jokes/google_login.php';

#####MySQL details#####
$db_username = "root"; //Database Username
$db_password = "root"; //Database Password
$host_name = "localhost"; //MySQL Hostname
$db_name = 'jokes'; //Database Name
#######################

//create a new connection to the Google login service
$client = new Google_Client();
$client -> setClientId($client_id);
$client -> setClientSecret($client_secret);
$client -> setRedirectUri($redirect_uri);
$client -> addScope("email");
$client -> addScope("profile");
$service = new Google_Service_Oauth2($client);

//There are multiple cases that this page handles depending on what GET values and Session variables are set
//case 1 - logout the user
if(isset($_GET['logout'])){
	$client -> revokeToken($_SESSION['access_token']);
	session_destroy();
	header('Location: index.php');
}

//case 2 - the URL contains a code from the Google login service
if(isset($_GET['code'])){
	$client -> authenticate($_GET['code']);
	$_SESSION['access_token'] = $client -> getAccessToken();
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	exit;
}

//case 3 - the access_token session variable is set. The user has been logged in. 
//if the user has not been loggged in, set the variable $authUrl to the login page
if(isset($_SESSION['access_token']) && $_SESSION['access_token']){
	$client -> setAccessToken($_SESSION['access_token']);
} else {
	$authUrl = $client -> createAuthUrl();
}

//case 4 - the user is not logged in. Display the login page.
echo '<div style="margin:20px>';
if(isset($authUrl)){
	//show login url
	echo '<div align="center>';
	echo '<h3>Login</h3>';
	echo '<div>You will need a Google account to sign in.</div>';
	echo '<a class="login" href="' . $authUrl . '">Login here</a>';
	echo '</div>';
} else{
	//case 5 - user has been logged in. Display data about him and add him to the my SQL database
	$user = $service -> userinfo -> get(); //get user info

	//connect to database
	$mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
	if($mysqli -> connect_error){
		die('Error : ('. $mysqli -> connect_errno . ') ' . $mysqli -> connect_error);
	}

	//check if user exists in google_users table

	$stmt = $mysqli->prepare("SELECT id, username, password, google_id, google_name, google_email, google_picture_link FROM users WHERE google_id=?");
	$stmt->bind_param("s", $user->id);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($userid, $username, $password, $google_id, $google_name, $google_email, $google_picture_link);

	if($stmt->num_rows > 0){
		//we found a record in the users table. This is a returning user
		echo "<h2>Welcome back" . $user->name. "!</h2>";
		echo "<p><a href='" . $redirect_uri. "?logout=1'>Log Out</a></p>";
		echo "<p><a href='index.php'>Go to main page</a></p>";

		while ($stmt->fetch()){
			echo "According to the database records you are:<br>";
			echo "<br>userid = " . $userid;
			echo "<br>username = " . $username;
			echo "<br>password = " . $password;
			echo "<br>google_id = " . $google_id;
			echo "<br>google_name = " . $google_name;
			echo "<br>google_email = " . $google_email;
			echo "<br>google_picture_link = " . $google_picture_link;
		}

		//save the login for other pages in the app to utilize
		$_SESSION['username']=$user->name;
		$_SESSION['googleuserid']=$user->id;
		$_SESSION['useremail']=$user->email;
		$_SESSION['userid']=$userid;

	}

	else{
		//this user is not found in the users table yet. New user
		echo "<h2>Welcome " . $user->name . " Thanks for Registering!</h2>";
	//put the user into the google users table
		$statement = $mysqli->prepare("INSERT INTO users(google_id,google_name,google_email,google_picture_link) VALUES (?,?,?,?)");
		$statement->bind_param('ssss', $user->id, $user->name, $user->email, $user->picture);
		
		$statement->execute();
		$newuserid = $statement->insert_id;
		echo $mysqli->error;
		echo "<p>Created new user:</p>";

		echo "New user id = " . $newuserid . "<br>";
		echo "<br>username = "; //left blank for google users
		echo "<br>password = "; //left blank for google users
		echo "<br>google_id = " . $user->id;
		echo "<br>google_name = " . $user->name;
		echo "<br>google_email = " . $user ->email;
		echo "<br>google_picture_link = " . $user ->picture;

		$_SESSION['userid'] = $newuserid;
		$_SESSION['username'] = $user->name;
		$_SESSION['googleuserid'] = $user->id;
		$_SESSION['useremail'] = $user->email;

		//print user details
		echo "<p>About this user</p>";
		echo "<ul>";
		echo "<img src'" . $user->picture . "'/>";
		echo "<li>Username: " . $user->name . "</li>";
		echo "<li>User ID: " . $_SESSION['userid'] . "</li>";
		echo "<li>User Email: " . $user->email . "</li>";
		echo "</ul>";
		echo "<p>Now go check the database to see if the new user has been inserted into the table.</p>";
		echo "<a href = 'index.php'>Return to the main page</a>";

		echo "<br>Session values = <br>";
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";


	}






	/*$result = $mysqli -> query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user->id");
	$user_count = $result ->fetch_object() -> usercount; //will return 0 if user doesn't exist

	//show user picture
	echo '<img src="' . $user -> picture. '" style="float: right;margin-top: 33px;" />';

	if($user_count) // if user already exist change greeting text to "Welcome back"
	{
		echo 'Welcome back '. $user ->name. '! [<a href="' . $redirect_uri. '?logout=1">Log Out</a>]';
	} else //else greeting text "Thanks for registering"
	{
		echo 'Hi '.$user->name. ', Thanks for Registering! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
		$statement = $mysqli->prepare("INSERT INTO users (google_id, google_name, google_email, google_link, google_picture_link) VALUES (?,?,?,?,?)");
		$statement -> bind_param('issss', $user->id, $user->name, $user->email, $user->link, $user->picture);
		$statement -> execute();
		echo $mysqli->error;

		//print user details
		echo "<p>Data about this user. <ul><li>Username: ". $user->name . "</li><li>user id: " . $user->id . "</li><li>email: " . $user->email . "</li></ul></p>";

		//set session variable that will be used by other pages in the application
		$_SESSION['username']=$user->name;
		$_SESSION['userid']=$user->id;
		$_SESSION['useremail']=$user->email; 
	}
	echo '</div>';*/
}

?>