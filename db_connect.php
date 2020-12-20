<?php

//4 variables to connect to database
$host = "localhost";
$username = "root";
$user_pass = "root";
$database_in_use = "jokes";

//create database connection instance
$mysqli = new mysqli($host, $username, $user_pass, $database_in_use);

?>