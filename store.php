<?php
$title = "Home";
include "head.php";
include "navbar.php";



?>
<main id="store_main">
  <div class="store_container">
    <div class="store_filter">
      <div class="form">
        <div class="category_container">
          <p>Categories:</p>
          <ul class="category_filter">
            <li>
              <input type="checkbox" name="action" id="action" class="category">
              <label for="action">action</label>

            </li>
            <li>
              <input type="checkbox" name="sport" id="sport" class="category">
              <label for="sport">sport</label>

            </li>
            <li>
              <input type="checkbox" name="rpg" id="rpg" class="category">
              <label for="rpg">RPG</label>

            </li>
            <li>
              <input type="checkbox" name="horror" id="horror" class="category">
              <label for="horror">horror</label>

            </li>
            <li>
              <input type="checkbox" name="adventure" id="adventure" class="category">
              <label for="adventure">adventure</label>

            </li>
          </ul>
        </div>
        <!-- x -->
        <div class="category_container">
          <p>Devices:</p>
          <ul class="category_filter">
            <li>
              <input type="checkbox" name="pc" id="pc" class="device">
              <label for="pc">PC</label>
            </li>
            <li>
              <input type="checkbox" name="xbox" id="xbox" class="device">
              <label for="xbox">XBOX</label>
            </li>
            <li>
              <input type="checkbox" name="ps4" id="ps4" class="device">
              <label for="ps4">PS4</label>
            </li>
            <li>
              <input type="checkbox" name="nintendo" id="nintendo" class="device">
              <label for="nintendo">Nintendo</label>

            </li>
          </ul>
        </div>
        <!-- x -->
        <div class="category_container">
          <p>Devices:</p>
          <ul class="category_filter filter_column">
            <li>
              <input type="number" name="min" id="min" min="0" max="50" class="price">
              <label for="min">MIN</label>
            </li>
            <li>
              <input type="number" name="max" id="max" max="50" min="0" class="price">
              <label for="max">MAX</label>
            </li>

          </ul>
        </div>
        <button class="filter_submit" onclick="build_a_link()">submit</button>
      </div>
    </div>
    <?php
    include "store_products.php";
    ?>
  </div>

  <ul class="pagination">
    <li>
      <a href="store.php?i=12&m=1">1</a>
    </li>
    <li>
      <a href="store.php?i=24&m=13">2</a>
    </li>
    <li>
      <a href="store.php?i=36&m=25">3</a>
    </li>
  </ul>
</main>



<?php
include "footer.php";
include "foot.php";
?>
<script src="assets/scripts/store.js"></script>