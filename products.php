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

          <span style="color:<?php echo $row['quantity'] > 0 ? "green" : "red"; ?>">
            <?php
            echo $row['quantity'] > 0 ? "in stock" : "out of stock";
            ?>
          </span>
          <a href="product.php?product_id=<?php echo $row['id'] ?>" aria-label="productpage link">
            <img src="<?php echo 'assets/images/products/' . $row['image'] . ".webp" ?>" alt="<?php echo $row['name'] ?>">
          </a>
        </div>
        <div class="product--inner-container">
          <div class="product-info">
            <p>
              <?php echo $row['name'] ?>
            </p>
            <p>
              <?php echo $row['price'] . "$" ?>
            </p>
          </div>
          <a href="#" aria-label="product add button">
            <ion-icon name="cart-outline"></ion-icon>
          </a>
        </div>
      </div>
      <?php
    }
  }
  ?>
</div>