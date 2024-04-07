<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "therapy";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
  die("Error: Unable to connect to the database. Please ensure the database server is running and check your connection settings.");
}
