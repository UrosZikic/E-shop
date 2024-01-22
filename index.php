<?php
session_start();
$_SESSION['title'] = "Home page";
session_destroy();
include "head.php";
include "navbar.php";

?>
<main>
  <div>
    <div class="header_component">
      <img src="assets/images/bg-image.webp" alt="scented candles" class="head_image">
      <div class="h_component_inner">
        <div>
          <p>🌱</p>
          <h1>The nature candle</h1>
          <p>All handmade with natural soy wax, Candleleaf is a companion for all your pleasure moments</p>
        </div>
        <a href="#products">Discover out collection</a>
      </div>
    </div>
    <h2 class="product-heading">
      Products
    </h2>
    <p class="product-paragraph">order it for you or for your belowed ones</p>

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
  } else {
    console.log(reset_cart_now);
  }
</script>
<script>
  // JavaScript code to remove the success_msg parameter from the URL
  if (window.history.replaceState) {
    // Use replaceState to modify the URL without reloading the page
    window.history.replaceState({}, document.title, window.location.pathname);
  }
</script>
<?php
include "foot.php";
?>