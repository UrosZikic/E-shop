<?php
session_start();
$_SESSION['title'] = "Cart page";
session_destroy();

include "head.php";
include "navbar.php";
include "connection.php";
include "cart_collection.php";



?>
<main class="cart_main">
  <div class="cart_container">
    <?php
    // Fetch the results
    ?>
    <div class="cart_titles">
      <span></span>
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
          <a href="product.php?product_id=<?php echo $row['id'] ?>" aria-label="productpage link">
            <img src="<?php echo "assets/images/products/" . $row['image'] . '.webp' ?>" alt="<?php echo $row['name'] ?>">
          </a>
          <div class="cart-product">
            <p class="cart-product-name">
              <?php
              echo $row['name'];
              ?>
            </p>
            <button class="remove_product_btn">Remove</button>
          </div>
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
  <div class="total_price_container">
    <div>
      <p>Sub-total Price: $ <span class="total_price_sum"></span></p>
      <p style="color: gray;">Tax and shipping cost will be calculated later</p>
    </div>
    <button href="checkout.php" class="checkout_btn_styles checkout_forward">Check
      out</button>
  </div>
</main>

<?php
include "footer.php";
include "foot.php";
?>