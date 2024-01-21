<?php
include "head.php";
include "navbar.php";
include "connection.php";
include "cart_collection.php";

if (isset($_POST['submit_order'])) {
  $email = trim($_POST['email']);
  $first_name = trim($_POST['first_name']);
  $second_name = trim($_POST['second_name']);
  $address = trim($_POST['address']);
  $phone_number = trim($_POST['phone_number']);
  $city = trim($_POST['city']);
  $postal_code = trim($_POST['postal_code']);
  $stringify_order = implode(',', $cart_collection);

  echo $email;
  echo $first_name;
  echo $second_name;
  echo $address;
  echo $phone_number;
  echo $city;
  echo $postal_code;
  echo $stringify_order;

  $query = "INSERT INTO `order` (`email`, `name`, `surname`, `address`, `phone_number`, `city`, `postal_code`, `order`) VALUES 
  ('" . $email . "', '" . $first_name . "', '" . $second_name . "', '" . $address . "', '" . $phone_number . "', '" . $city . "', '" . $postal_code . "', '" . $stringify_order . "');";

  $order = $conn->query($query);


  if ($order) {
    //uspesno izmenjen student, prebaci ga na index.php
    header("location: index.php");
    exit();
  } else {
    //doslo je do greske
    echo "<p>DOSLO JE DO GRESKE</p>";
  }
}


?>
<main class="checkout_page">
  <div class="checkout_page_information">
    <form action="#" method="post" class="sticky">
      <div>
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
      <input type="submit" placeholder="Submid order" name="submit_order" value="Order">
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