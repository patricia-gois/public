<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdcineskills_patriciagois_n24";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>