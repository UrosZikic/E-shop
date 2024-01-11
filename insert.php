<?php
require_once "connection.php";

$query = "INSERT INTO `products` VALUES
(1, 'product 1', 20, 'image 1', 8.99),
(2, 'product 2', 20, 'image 2', 8.99),
(3, 'product 3', 20, 'image 3', 8.99),
(4, 'product 4', 20, 'image 4', 8.99),
(5, 'product 5', 20, 'image 5', 8.99),
(6, 'product 6', 20, 'image 6', 8.99),
(7, 'product 7', 20, 'image 7', 8.99),
(8, 'product 8', 0, 'image 8', 9.99)
";

$result = $conn->query($query);
?>