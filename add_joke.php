<?php
/*error_reporting(E_ALL);
ini_set('display_errors',1);*/
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
/*if(! $_SESSION['userid']){
	echo "Only logged in users may access this page. Click <a href = 'login_form.php' here</a> to login<br>";
	exit;
}*/
include "db_connect.php";
$new_joke_question = addslashes($_GET["newjoke"]);
$new_joke_answer = addslashes($_GET["newanswer"]);
$userid = $_SESSION['userid'];



//Search the database for the word chicken
echo "<h2>Trying to add a new joke:". $new_joke_question ."and". $new_joke_answer. " </h2>";

$stmt = $mysqli->prepare("INSERT INTO joke_table(joke_id, joke_question, joke_answer, users_id) VALUES(null, ?, ?, ?)");
$stmt->bind_param("ssi", $new_joke_question, $new_joke_answer, $userid);

echo "<pre>";
print_r($stmt);
echo "</pre>";

$result = $stmt->execute();
echo "<pre>";
print_r($result);
echo "</pre>";

$stmt->close();


include "seach_all_jokes.php";

echo "<br><a href = 'index.php'>return to mainpage</a>";
?>

