<?php
$server = "localhost";
$username = "uros";
$password = "15121714";
$database = "iwkms";
$conn = new mysqli($server, $username, $password, $database);

if ($conn->connect_error) {
  header("location: error.php?m=" . $conn->connect_error);
}

$conn->set_charset("utf8");


?>