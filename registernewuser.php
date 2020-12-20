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
<h1>Please register</h1>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
include "db_connect.php";

//include "seach_all_jokes.php";
?>


<form class="form-horizontal" action = "processnewuser.php">
<fieldset>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="username">Username</label>  
  <div class="col-md-5">
  <input id="username" name="username" type="text" placeholder="Your Username" class="form-control input-md" required="">
  <span class="help-block">Please enter a username</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password1">Password</label>  
  <div class="col-md-5">
  <input id="password1" name="password1" type="password" placeholder="Your Password" class="form-control input-md" required="">
  <span class="help-block">Please enter a password</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password2">Password</label>  
  <div class="col-md-5">
  <input id="password2" name="password2" type="password" placeholder="Your Password" class="form-control input-md" required="">
  <span class="help-block">Please confirm the password</span>  
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Create new user</button>
  </div>
</div>

</fieldset>
</form>

  

<?php 
$mysqli->close();
 

?>

</body>
</html>