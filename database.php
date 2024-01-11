<?php
require_once "connection.php";

$query = "CREATE TABLE IF NOT EXISTS `products`( 
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `quantity` INT,
  `image` VARCHAR(20),
  `price` DOUBLE(10, 2) NOT NULL
  )ENGINE=INNODB;";

// EXECUTE QUERIES
if (
  $conn->multi_query($query)
) {
  echo "<p>Tables created successfully!</p>";
} else {
  header("Location: error.php?m=" . $conn->error);
}
?>