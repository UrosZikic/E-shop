<?php
require_once "connection.php";

$query = "INSERT INTO `products` VALUES
(1, 'product 1', 20, 'image 1', 8.99, 'action', 'PC'),
(2, 'product 2', 20, 'image 2', 8.99, 'horror', 'PC'),
(3, 'product 3', 20, 'image 3', 8.99, 'adventure', 'XBOX'),
(4, 'product 4', 20, 'image 4', 8.99, 'RPG', 'PS4'),
(5, 'product 5', 20, 'image 5', 8.99, 'sport', 'PS4'),
(6, 'product 6', 20, 'image 6', 8.99, 'action', 'PC'),
(7, 'product 7', 20, 'image 7', 8.99, 'horror', 'PS4'),
(8, 'product 8', 0, 'image 8', 9.99, 'RPG', 'XBOX')
";

$query .= "INSERT INTO `products_regular` VALUES
(1, 'product 9', 20, 'image 7', 8.99, 'horror', 'PS4'),
(2, 'product 10', 0, 'image 8', 9.99, 'RPG', 'XBOX'),
(3, 'product 11', 20, 'image 1', 8.99, 'action', 'PC'),
(4, 'product 12', 20, 'image 2', 8.99, 'horror', 'PC'),
(5, 'product 13', 20, 'image 3', 8.99, 'adventure', 'XBOX'),
(6, 'product 14', 20, 'image 4', 8.99, 'RPG', 'PS4'),
(7, 'product 15', 20, 'image 5', 8.99, 'sport', 'PS4'),
(8, 'product 16', 20, 'image 6', 8.99, 'action', 'PC'),
(9, 'product 17', 20, 'image 7', 8.99, 'horror', 'PS4'),
(10, 'product 18', 0, 'image 8', 9.99, 'RPG', 'XBOX'),
(11, 'product 19', 20, 'image 1', 8.99, 'action', 'PC'),
(12, 'product 20', 20, 'image 2', 8.99, 'horror', 'PC'),
(13, 'product 21', 20, 'image 3', 8.99, 'adventure', 'XBOX'),
(14, 'product 22', 20, 'image 4', 8.99, 'RPG', 'PS4'),
(15, 'product 23', 20, 'image 5', 8.99, 'sport', 'PS4'),
(16, 'product 24', 20, 'image 6', 8.99, 'action', 'PC'),
(17, 'product 25', 20, 'image 7', 8.99, 'horror', 'PS4'),
(18, 'product 26', 0, 'image 8', 9.99, 'RPG', 'XBOX'),
(19, 'product 27', 20, 'image 1', 8.99, 'action', 'PC'),
(20, 'product 28', 20, 'image 2', 8.99, 'horror', 'PC'),
(21, 'product 29', 20, 'image 3', 8.99, 'adventure', 'XBOX'),
(22, 'product 30', 20, 'image 4', 8.99, 'RPG', 'PS4'),
(23, 'product 31', 20, 'image 5', 8.99, 'sport', 'PS4'),
(24, 'product 32', 20, 'image 6', 8.99, 'action', 'PC'),
(25, 'product 33', 20, 'image 7', 8.99, 'horror', 'PS4'),
(26, 'product 34', 0, 'image 8', 9.99, 'RPG', 'XBOX'),
(27, 'product 35', 20, 'image 1', 8.99, 'action', 'PC'),
(28, 'product 36', 20, 'image 2', 8.99, 'horror', 'PC'),
(29, 'product 37', 20, 'image 3', 8.99, 'adventure', 'XBOX'),
(30, 'product 38', 20, 'image 4', 8.99, 'RPG', 'PS4'),
(31, 'product 39', 20, 'image 5', 8.99, 'sport', 'PS4'),
(32, 'product 40', 20, 'image 6', 8.99, 'action', 'PC'),
(33, 'product 41', 20, 'image 7', 8.99, 'horror', 'PS4'),
(34, 'product 42', 0, 'image 8', 9.99, 'RPG', 'XBOX'),
(35, 'product 43', 20, 'image 1', 8.99, 'action', 'PC'),
(36, 'product 44', 20, 'image 2', 8.99, 'horror', 'PC')
";

$result = $conn->query($query);
?>