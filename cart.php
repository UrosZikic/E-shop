<?php
include "head.php";
include "navbar.php";
include "connection.php";


if (isset($_COOKIE['js_var_value'])) {
  $cart_collection = $_COOKIE['js_var_value'];
  // Remove unwanted characters

  $cart_collection = explode(',', $cart_collection);




  $cart_product_name = [];
  $cart_product_quantity = [];




  for ($i = 0; $i < count($cart_collection); $i++) {
    if ($i % 2 == 0) {
      array_push($cart_product_name, $cart_collection[$i]);
    } else {
      array_push($cart_product_quantity, $cart_collection[$i]);
    }
  }
  ;


  $placeholders = implode(', ', array_fill(0, count($cart_product_name), '?'));
  $orderByClause = 'FIELD(`name`, ' . implode(', ', array_map(function ($item) {
    return "'" . $item . "'"; }, $cart_product_name)) . ')';
  $queryProducts = "SELECT * FROM `products` WHERE `name` IN ($placeholders) ORDER BY $orderByClause";
  $stmt = $conn->prepare($queryProducts);
  $stmt->bind_param(str_repeat('s', count($cart_product_name)), ...$cart_product_name);
  $stmt->execute();
  $result = $stmt->get_result();
}

?>
<div class="cart_container">
  <?php
  // Fetch the results
  ?>
  <div class="cart_titles">
    <strong>Product</strong>
    <strong>Price</strong>
    <strong>Quantity</strong>
    <strong>Total</strong>
  </div>
  <?php
  while ($row = $result->fetch_assoc()) {
    ?>
    <div class="cart_product_container">
      <div class="cart_name_image_container">
        <img src="<?php echo "assets/images/products/" . $row['image'] . '.webp' ?>" alt="<?php echo $row['name'] ?>">

        <p class="cart-product-name">
          <?php
          echo $row['name'];

          ?>
        </p>
      </div>
      <p>$
        <?php echo "<span class='cart-product-price'>" . $row['price'] . "</span>" ?>
      </p>
      <div class="cart-qnt-adjuster">
        <button class="cart-qnt-increment">+</button>
        <p class="cart-qnt-display">
          <?php
          if (in_array($row['name'], $cart_product_name)) {
            $key = array_search($row['name'], $cart_product_name);
            echo $cart_product_quantity[$key];
          }
          ?>
        </p>
        <button class="cart-qnt-decrement">-</button>
      </div>
      <p>
        $
        <span class="cart-product-total-price">
          <?php
          echo ($row['price']) * $cart_product_quantity[$key];
          ?>
        </span>
      </p>
    </div>
    <?php
  }

  ?>
</div>


<?php
include "footer.php";
include "foot.php";
?>