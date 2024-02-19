<?php
include 'connection.php';
$upr_limit = $_GET['i'];
$lwr_limit = $_GET['m'];
$category = isset($_GET['category']) ? $_GET['category'] : null;
$device = isset($_GET['device']) ? $_GET['device'] : null;
$price = isset($_GET['price']) ? $_GET['price'] : null;

if ($category != null) {
  $category = explode(',', $category);
}
if ($device != null) {
  $device = explode(',', $device);
}
if ($price != null) {
  $price = explode(',', $price);
}
$limit = 12;
function list_products($limit, $conn, $lwr_limit, $upr_limit, $category, $device, $price)
{
  $queryProducts = "";
  if ($category == null && $device == null && $price == null) {
    $queryProducts = 'SELECT * FROM `products_regular` WHERE `id` >= ' . $lwr_limit . ' AND `id` <= ' . $upr_limit . ' LIMIT ' . $limit;
  } else {
    if ($device == null && $price == null) {
      $categoryString = implode("','", $category);
      $queryProducts = "SELECT * FROM `products_regular` WHERE `category` IN ('$categoryString')";
    } else if ($category == null && $price == null) {
      $deviceString = implode("','", $device);
      $queryProducts = "SELECT * FROM `products_regular` WHERE `category` IN ('$deviceString')";
    } else if ($category == null && $device == null) {
      $queryProducts = "SELECT * FROM `products_regular` WHERE `price` >= $price[0] && `price` <= $price[1]";
    } else if ($category != null && $device != null && $price == null) {
      $categoryString = implode("','", $category);
      $deviceString = implode("','", $device);
      $queryProducts = "SELECT * FROM `products_regular` WHERE `category` IN ('$categoryString') && `device` IN ('$deviceString')";
    } else if ($category == null && $device != null && $price != null) {
      $deviceString = implode("','", $device);
      $queryProducts = "SELECT * FROM `products_regular` WHERE `device` IN ('$deviceString') && `price` >= $price[0] && `price` <= $price[1]";
    } else if ($category != null && $device == null && $price != null) {
      $categoryString = implode("','", $category);
      $queryProducts = "SELECT * FROM `products_regular` WHERE `category` IN ('$categoryString') && `price` >= $price[0] && `price` <= $price[1]";
    } else {
      $categoryString = implode("','", $category);
      $deviceString = implode("','", $device);

      $queryProducts = "SELECT * FROM `products_regular` WHERE `category` IN ('$categoryString') && `device` IN ('$deviceString') && `price` >= $price[0] && `price` <= $price[1]";

    }
  }
  $resultProducts = $conn->query($queryProducts);

  return $resultProducts;
}
$resultProducts = list_products($limit, $conn, $lwr_limit, $upr_limit, $category, $device, $price);
display_products($resultProducts);


?>
<?php
function display_products($resultProducts)
{
  ?>
  <!-- <div class="products_container"> -->

  <div class="products" id="products">
    <?php

    if ($resultProducts->num_rows != 0) {
      while ($row = $resultProducts->fetch_assoc()) {
        ?>
        <div class="product">
          <div class="product-image">

            <span style="color:<?php echo $row['quantity'] > 0 ? "#224934" : "#7E1B1B"; ?>; font-weight: 500;">
              <?php
              $is_in_stock = $row['quantity'] > 0 ? "in stock" : "out of stock";
              echo $is_in_stock;
              ?>
            </span>

            <ion-icon name="checkmark-outline" class="success-mark"></ion-icon>

            <a href="store_product.php?product_id=<?php echo $row['id'] ?>" aria-label="productpage link">
              <img src="<?php echo 'assets/images/products/' . $row['image'] . ".webp" ?>" alt="<?php echo $row['name'] ?>"
                loading="lazy">
            </a>
          </div>
          <div class="product--inner-container">
            <div class="product-info">
              <p class="product_name">
                <?php echo $row['name'] ?>
              </p>
              <p>
                <?php echo $row['price'] . "$" ?>
              </p>
            </div>
            <button onclick="push_to_cart(<?php echo $row['id'] ?>, 1, true, 20, '<?php echo $row['name'] ?>', 'regular')"
              class="<?php echo $row['quantity'] > 0 ? "" : 'disabled' ?> add_to_cart_alt" aria-label="product_page_button">
              <ion-icon name="cart-outline"></ion-icon>
            </button>
          </div>
        </div>
        <?php
      }
    }

    ?>
  </div>

  <!-- </div> -->
<?php }
; ?>