<?php
ob_start();

$title = "Checkout";

include "head.php";
include "navbar.php";
include "connection.php";
include "cart_collection.php";
include "cart_collection_regular.php";

if (isset($_POST['submit_order'])) {
  $email = trim($_POST['email']);
  $first_name = trim($_POST['first_name']);
  $second_name = trim($_POST['second_name']);
  $address = trim($_POST['address']);
  $phone_number = trim($_POST['phone_number']);
  $city = trim($_POST['city']);
  $postal_code = trim($_POST['postal_code']);
  $cart_checkout = $_COOKIE['js_var_value'];
  $date = date('Y-m-d H:i:s');

  $stmt = $conn->prepare("INSERT INTO `orders` (`email`, `name`, `surname`, `address`, `phone_number`, `city`, `postal_code`, `ordered`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssssss", $email, $first_name, $second_name, $address, $phone_number, $city, $postal_code, $cart_checkout, $date);

  if ($stmt->execute()) {
    header("location: index.php?success_msg=" . true . "&reset_cart=" . true);
    exit();
  } else {
    echo "<p>DOSLO JE DO GRESKE</p>";
  }

  $stmt->close();
}
?>
<script>
  if (localStorage.getItem('cart_info').length <= 2) {
    window.location.href = "index.php";
  }
</script>
<main class="checkout_page">
  <div class="checkout_page_information">
    <form id="order_form" method="post" class="sticky">
      <div class="contact_container">
        <label for="buyer_contact">Contact</label>
        <input type="email" id="buyer_contact" placeholder="Email" name="email" required>
      </div>
      <div>
        <label for="shippment">Shipping Information</label>
        <div id="shippment">
          <input type="text" placeholder="Name" name="first_name" required>
          <input type="text" placeholder="Surname" name="second_name" required>
        </div>
        <input type="text" placeholder="Address" name="address" required>
        <input type="text" placeholder="Phone number" name="phone_number" required>
        <div class="split-inputs">
          <input type="text" placeholder="City" name="city" required>
          <input type="number" placeholder="Postal code" name="postal_code" required>
        </div>
      </div>
      <input type="submit" placeholder="Submid order" name="submit_order" value="Order" id="submit_order_btn">
    </form>
  </div>
  <div class="checkout_page_product_container">
    <div class="checkout_page_product_container_inner">
      <?php
      while ($row = $result->fetch_assoc()) {
        ?>
        <div class="checkout_page_product">
          <div class="checkout_page_product_left">
            <img src="<?php echo "assets/images/products/" . $row['image'] . '.webp' ?>" alt="<?php echo $row['name'] ?>">
            <div class="checkout_page_product_qnt">
              <?php
              if (in_array($row['name'], $cart_product_name)) {
                $key = array_search($row['name'], $cart_product_name);
                echo $cart_product_quantity[$key];
              }
              ?>

            </div>
          </div>
          <div class="checkout_page_product_right">
            <p>
              <?php echo $row['name'] ?>
            </p>
            <p> $
              <?php
              echo ($row['price']) * $cart_product_quantity[$key];
              ?>
            </p>
          </div>
        </div>
      <?php }
      ; ?>
      <!-- xxxxx -->
      <?php
      while ($row_r = $result_r->fetch_assoc()) {
        ?>
        <div class="checkout_page_product">
          <div class="checkout_page_product_left">
            <img src="<?php echo "assets/images/products/" . $row_r['image'] . '.webp' ?>"
              alt="<?php echo $row_r['name'] ?>">
            <div class="checkout_page_product_qnt">
              <?php
              if (in_array($row_r['name'], $cart_product_name)) {
                $key = array_search($row_r['name'], $cart_product_name);
                echo $cart_product_quantity[$key];
              }
              ?>

            </div>
          </div>
          <div class="checkout_page_product_right">
            <p>
              <?php echo $row_r['name'] ?>
            </p>
            <p> $
              <?php
              echo ($row_r['price']) * $cart_product_quantity[$key];
              ?>
            </p>
          </div>
        </div>
      <?php }
      ; ?>
    </div>
    <!-- 2nd part -->
    <hr />
    <div class="total_price_summary">
      <div>
        <p>Subtotal</p>
        <p class="total_price_sum">
          <span>$
            <?php
            if (isset($_COOKIE['total_price'])) {
              $total_price = $_COOKIE['total_price'];
              echo $total_price;
            }
            ?>
          </span>
        </p>
      </div>
      <!-- x -->
      <div>
        <p>Shipping</p>
        <p>Free shipping</p>
      </div>
      <div>
        <p>Total</p>
        <p>$ <span class="total_price_sum">
            <?php
            if (isset($_COOKIE['total_price'])) {
              $total_price = $_COOKIE['total_price'];
              echo $total_price;
            }
            ?>
          </span></p>
      </div>
      <hr />
    </div>
  </div>



</main>
<?php
include "footer.php";
include "foot.php";

?>