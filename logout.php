<?php

session_start();

$_SESSION = NULL;
session_destroy();

echo "Logged out <br>";

?>
