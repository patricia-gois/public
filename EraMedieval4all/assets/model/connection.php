<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skillsmedieval_patriciagois_n24";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset( $conn, 'utf8');
date_default_timezone_set("Europe/Lisbon");

?>