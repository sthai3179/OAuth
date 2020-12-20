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
<h1>Joke Page</h1>
<a href="logout.php">Click here to log out<a>
<a href="login_form.php">Click here to login <a>
<a href="registernewuser.php">Click here to register<a>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
include "db_connect.php";

//include "seach_all_jokes.php";
?>


<form class="form-horizontal" action = "search_keyword.php">
<fieldset>

<!-- Form Name -->
<legend>Search for Joke</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="keyword">Text Input</label>  
  <div class="col-md-5">
  <input id="keyword" name="keyword" type="text" placeholder="e.g. spicy chicken sandwich" class="form-control input-md" required="">
  <span class="help-block">Enter a word to search in the joke database</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Search</button>
  </div>
</div>

</fieldset>
</form>

<hr>

<?php
session_start();
if (isset ($_SESSION['userid'])):
?>

<form class="form-horizontal" action="add_joke.php">
<fieldset>

<!-- Form Name -->
<legend>Add a joke</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newjoke">Joke Question</label>  
  <div class="col-md-6">
  <input id="newjoke" name="newjoke" type="text" placeholder="" class="form-control input-md">
  <span class="help-block">Enter your joke question here</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newanswer">Answer to your joke</label>  
  <div class="col-md-5">
  <input id="newanswer" name="newanswer" type="text" placeholder="" class="form-control input-md">
  <span class="help-block">Enter the punchline of your joke</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Add new joke</button>
  </div>
</div>

</fieldset>
</form>
<?php else: ?>
  <!-- login messegae will go here -->
<div align="center">
<h3>Login</h3>
<div>You will need a Google account to add a joke.</div>
<a href="google_login.php">Login here</a>
</div>
<?php endif; ?>


<!-- // <?php 
//$mysqli->close();
 

//?> */ -->

</body>
</html>