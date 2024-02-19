<?php
ob_start();
$title = "Product";
include "head.php";
include "navbar.php";
include 'connection.php';


$productId = $_GET['product_id'];

$queryProducts = 'SELECT * FROM `products_regular` WHERE `id`=' . $productId;
$resultProducts = $conn->query($queryProducts);
?>
<main class="product-container" id="product-container">
  <div class="product_success_overlay product_success_overlay_none">
    <div class="product_success product_success_initial">
      <p>Product added to cart successfully</p>
      <div>
        <button class="proceed_to_cart">Proceed to cart</button>
        <button class="keep_shopping">Keep shopping</button>
      </div>
    </div>
  </div>
  <?php
  if ($resultProducts->num_rows != 0) {
    while ($row = $resultProducts->fetch_assoc()) {
      setcookie("productQuantity", $row['quantity'], time() + 3600, "/");
      ?>
      <div class="single-product-left">
        <img src="<?php echo "assets/images/products/" . $row['image'] . '.webp' ?>" alt="<?php echo $row['name'] ?>" />
        <strong>All hand-made with natural soy wax, Candleaf is made for your pleasure moments.</strong>
        <p> &#128666 free shipping</p>
      </div>
      <div class="single-product-right">
        <h1 class="product_name">
          <?php echo $row['name'] ?>
        </h1>
        <div class="product-right-layout">
          <div class="product-right-layout-one">

            <p>
              <?php echo "$" . $row['price'] ?>
            </p>
            <div>
              <p>Quantity</p>

              <div class="qnt-adjuster">
                <button class="qnt-decrement">-</button>

                <p class="qnt-display">
                  <?php echo $row['quantity'] ? 1 : 0 ?>
                </p>
                <button class="qnt-increment">+</button>

              </div>
            </div>
          </div>
          <!-- x -->
          <div class="product-right-layout-two">
            <div>

              <div class="radio-container">
                <input type="radio" name="purchase-type" id="one-time-purchase">
                <label for="one-time-purchase">One time purchase</label>
              </div>
            </div>
            <!-- y -->
            <div>
              <div class="radio-container">
                <input type="radio" name="purchase-type" id="subscribe">
                <label for="subscribe">Subscribe and receive a new delivery every week</label>
              </div>
              <p class="subscribe-label">Subscribe now and get the 10% of discount on every recurring order. The discount
                will be applied at
                checkout.</p>
            </div>

            <button class="add_to_cart"
              onclick="push_to_cart(<?php echo $row['id'] ?>, false, false, <?php echo $row['quantity'] ?>, '<?php echo $row['name'] ?>')"
              <?php echo $row['quantity'] == 0 ? "disabled" : ""; ?>
              style="<?php echo $row['quantity'] == 0 ? "background-color: gray" : ""; ?>">Add to
              cart</button>

          </div>

        </div>
        <div class="product-information">
          <p><strong>Wax:</strong> Top grade Soy wax that delivers a smokeless, consistent burn.</p>
          <p><strong>Fragrance:</strong> Premium quality ingredients with natural essential oils</p>
          <p><strong>Burning Time:</strong> 70-75 hours <strong>Dimension:</strong> 10cm x 5cm <strong>Weight:</strong>
            400g</p>
        </div>
      </div>
      <?php
    }
  }

  ?>
</main>


<?php
include "footer.php";
include "foot.php";
?>