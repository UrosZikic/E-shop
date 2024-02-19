<?php
include 'connection.php';
$queryProducts = 'SELECT * FROM `products`';
$resultProducts = $conn->query($queryProducts);
?>
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

          <a href="product.php?product_id=<?php echo $row['id'] ?>" aria-label="productpage link">
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
          <!--<button onclick="push_to_cart(<?php echo $row['id'] ?>, 1, true)"-->
          <!--  class="<?php echo $row['quantity'] > 0 ? "" : 'disabled' ?> add_to_cart_alt" aria-label="product_page_button">-->
          <!--  <ion-icon name="cart-outline"></ion-icon>-->
          <!--</button>-->
          <button onclick="push_to_cart(<?php echo $row['id'] ?>, 1, true, 20, '<?php echo $row['name'] ?>', 'special')"
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