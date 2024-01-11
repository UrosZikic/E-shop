<?php
require_once "connection.php";

$poruka = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['m'])) {
  $poruka = $_GET['m'];
}

?>