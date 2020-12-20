  <?php

session_start();

error_reporting(E_ALL);
ini_set('display errors', 1);

include "db_connect.php";
$username = $_POST['username'];
$password = $_POST['password'];


echo "You attempted to login with username: " . $username . " and " . $password . "<br>"; 



$stmt = $mysqli->prepare("SELECT id, username, password FROM users where username = ? and password = ?");
$stmt->bind_param("ss", $username, $password);

$stmt->execute();
$stmt->store_result();

$stmt->bind_result($userid, $uname, $pw);


echo "<pre>";
print_r($stmt);   
echo "</pre>";

  echo "Select returned " . $stmt->num_rows . " rows of data<br>";
 

if ($stmt->num_rows > 0) {
  echo "num rows is greater than 0 " . $stmt->num_rows . "<br>";
  $row = $stmt-> fetch();
   
  echo "results<br>";
  echo "userid=" . $userid . "<br>";
echo "uname=" . $uname . "<br>";
echo "pw=" . $pw . "<br>";
 
 
 
  echo "Login successful <br>";
  $_SESSION['username']=$uname;
  $_SESSION['userid'] = $userid;

  echo"<div>";


} else {
  echo "0 results. Nobody with that username and password";
  $_SESSION = [];
  session_destroy();
  echo "<br><a href = 'index.php'>return to mainpage</a>";
}

echo "SESSION = <br>";
echo "<pre>";
print_r($_SESSION);
echo "/<pre>";


?>

