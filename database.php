<?php
require_once "connection.php";

$query = "CREATE TABLE IF NOT EXISTS `products`( 
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `quantity` INT,
  `image` VARCHAR(20),
  `price` DOUBLE(10, 2) NOT NULL
  )ENGINE=INNODB;";

$query .= "CREATE TABLE IF NOT EXISTS `orders`(
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(50) NOT NULL,
  `name` VARCHAR(20) NOT NULL,
  `surname` VARCHAR(30) NOT NULL,
  `address` VARCHAR (200) NOT NULL,
  `phone_number` VARCHAR(50) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `postal_code` INT NOT NULL ,
  `ordered` VARCHAR(1000) NOT NULL,
  `date` VARCHAR(200) NOT NULL
)ENGINE=INNODB;";

// EXECUTE QUERIES
if (
  $conn->multi_query($query)
) {
  echo "<p>Tables created successfully!</p>";
} else {
  header("Location: error.php?m=" . $conn->error);
}
