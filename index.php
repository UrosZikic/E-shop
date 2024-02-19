<?php
session_start();
$title = "Home page";
session_destroy();
include "head.php";
include "navbar.php";

?>
<main>
  <div>
    <div class="header_component">
          <img src="https://images.unsplash.com/photo-1617387247740-7006c0fd700c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="scented candles" class="head_image">
      <div class="h_component_inner">
        <div>
          <p>🌱</p>
          <h1>The nature candle</h1>
          <p>Crafted entirely by skilled hands using natural soy wax, Candleleaf is your perfect companion for moments
            of pure pleasure. </p>
        </div>
    
        <a href="#products">Discover out collection</a>
      </div>
    </div>
    <h2 class="product-heading">
      Products
    </h2>
    <p class="product-paragraph">
      Indulge yourself or treat your beloved ones to the exquisite experience of Candleleaf. </p>

    <?php
    if (isset($_GET['success_msg'])) {
      echo "<div class='success_msg'><p>Thank you for your purchase!</p></div>";
    }
    ?>

    <?php
    include "products.php";
    include "description.php";

    ?>

</main>
<?php
include "footer.php";
?>
<script>
  const urlParams = new URLSearchParams(window.location.search);

  // Get the value of 'other_arg' parameter
  const reset_cart_now = urlParams.get('reset_cart');

  // Check if the parameter exists before using it
  if (reset_cart_now !== null) {
    (function reset_cookies() {
      document.cookie = "js_var_value = " + [];
    })();
  }
 
  
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="assets/scripts/carousel.js"></script>
<?php
include "foot.php";
?>