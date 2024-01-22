<?php
include "head.php";
?>
<?php
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
    include "footer.php";
    ?>

</main>
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