<html>

<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<h1>Login for Jokes</h1>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
include "db_connect.php";

//include "seach_all_jokes.php";
?>


<form class="form-horizontal" action = "process_login_unsecure.php" method = "post">
<fieldset>

<!-- Form Name -->
<legend>Please Login</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="username">Login</label>  
  <div class="col-md-5">
  <input id="username" name="username" type="text" placeholder="Your username" class="form-control input-md" required="">
  <span class="help-block">Enter your username</span>  
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>  
  <div class="col-md-5">
  <input id="password" name="password" type="password" placeholder="Your password" class="form-control input-md" required="">
  <span class="help-block">Enter your password</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Login</button>
  </div>
</div>

</fieldset>
</form>



<?php 
$mysqli->close();
 

?>

</body>
</html>