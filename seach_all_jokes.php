<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQuery UI Accordion - Default functionality</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui..js"></script>
	<script>
		$(function(){
			$("#accordion").accordion();
		});
	</script>

</head>
<?php
include "db_connect.php";

$sql = "SELECT joke_id, joke_question, joke_answer, users_id, username, google_name FROM joke_table on joke_table.users_id = users_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<b>". $row['joke_question']. "</b>";
    echo "<div><p>" . $row["joke_answer"] . "<br>Submitted by user# " . $row['users_id'] . "whose name is ". $row['username'] . $row['google_name']. "</p></div";
  }
} else {
  echo "0 results";
}

?>