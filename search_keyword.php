<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>

  <style>
    *{
      font-family: Arial, Helvetica, sans-serrif;
    }
  </style>

</head>

<?php

include "db_connect.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$keywordfromform = $_GET['keyword'];
echo $keywordfromform;

//Search the database for the word chicken
echo "<h1>Show all the jokes with the word $keywordfromform </h1>";

$keywordfromform = "%" . $keywordfromform . "%";

$stmt = $mysqli->prepare("SELECT joke_id, joke_question, joke_answer, users_id, username, google_name FROM joke_table JOIN users ON users.id = joke_table.users_id WHERE joke_question LIKE ?");

$stmt ->bind_param("s", $keywordfromform);

$stmt ->execute();
$stmt -> store_result();

$stmt -> bind_result($joke_id, $joke_question, $joke_answer, $users_id, $username, $google_name);

if($stmt->num_rows > 0){
  //output data of each row

  echo "<div id ='accordion'>";
  while($stmt->fetch()){
    $safe_joke_question = htmlspecialchars($joke_question);
    $safe_joke_answer = htmlspecialchars($joke_answer);

    echo "<h3>" . $safe_joke_question . "</h3>";

    echo "<div><p>" . $safe_joke_answer . " -- Submitted by user " . $username . $google_name . "</p></div>"; 
  }

  echo"</div>";
}

else{
  echo "0 results";
}

?>
