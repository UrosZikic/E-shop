<nav class="navbar navbar-expand-lg bg-white">
  <div class="container-fluid inner-nav">



    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <a class="navbar-brand" href="index.php">
      <img src="assets/images/logo.webp" alt="website logo">
    </a>


    <div class="collapse navbar-collapse flex-grow-0 responsive-dismiss" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#products">Discover</a>
        </li>
        <li class="nav-item link-margin">
          <a class="nav-link" href="#description_s">About</a>
        </li>
        <li class="nav-item link-margin">
          <a class="nav-link" href="store.php?i=12&m=1&d=0">Store</a>
        </li>
      </ul>
    </div>


    <div class="d-flex align-items-center gap-4">
      <!--<a href="profile.php" aria-label="profile-page">-->
      <!--  <ion-icon name="person-outline"></ion-icon> </a>-->
      <a href="cart.php" aria-label="cart" name="cart" class="cart_nav_container">
        <div class="cart-amount"></div>
        <ion-icon name="cart-outline"></ion-icon>
      </a>
      <button class="contact-button" onclick="open_modal_form()">
        <ion-icon name="mail-unread"></ion-icon>
      </button>
    </div>


    <div class="collapse flex-grow-0 normal-dismiss responsive-styles-nav" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#products">Discovery</a>
        </li>
        <li class="nav-item link-margin">
          <a class="nav-link" href="#description_s">About</a>
        </li>

      </ul>
    </div>



  </div>
</nav>
<?php
include "contact.php";
?>