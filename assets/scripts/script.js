"use strict";
const body = document.querySelector("body");

document.addEventListener("DOMContentLoaded", responsive_head_image);
window.addEventListener("resize", responsive_head_image);

function responsive_head_image() {
  const head_image = document.querySelector(".head_image");
  const responsive_nav = document.querySelector(".normal-dismiss");

  function responsive_head_image() {
    if (body.offsetWidth <= 800) {
      head_image.src = "assets/images/bg-image-mobile.webp";
    } else {
      head_image.src = "assets/images/bg-image.webp";
    }
    if (body.offsetWidth <= 991) {
      responsive_nav.classList.add("navbar-collapse");
    } else {
      responsive_nav.classList.remove("navbar-collapse");
    }
  }
}

if (document.querySelector(".description-section")) {
  const description_section = document.querySelector(".description-section");
  window.addEventListener("load", description_layout_check);
  window.addEventListener("resize", description_layout_check);

  function description_layout_check() {
    let description_content;
    if (body.offsetWidth > 1010) {
      description_content = `
   <div>
    <h2>Clean and fragrant soy wax
      <p>Made for your home and for your wellness</p>
    </h2>


    <ul>
      <li><strong>Eco-sustainable:</strong> All recyclable materials, %0 CO2 emissions</li>
      <li><strong>Hyphoallergenic:</strong> 100% natural, human friendly ingredients</li>

      <li><strong>Handmade:</strong> All candles are craftly made with love.</li>
      <li><strong>Long burning:</strong> No more waste. Created for last long.</li>
    </ul>
  </div>

  <img src="assets/images/image.webp" alt="scented candles">
   
   `;
    } else {
      description_content = `
    <div>
  <h2 style="text-align: center;">Clean and fragrant soy wax
      <p>Made for your home and for your wellness</p>
    </h2>

    <img src="assets/images/image.webp" alt="scented candles" style="width: 80%; height: 80%">

    <ul>
      <li><strong>Eco-sustainable:</strong> All recyclable materials, %0 CO2 emissions</li>
      <li><strong>Hyphoallergenic:</strong> 100% natural, human friendly ingredients</li>

      <li><strong>Handmade:</strong> All candles are craftly made with love.</li>
      <li><strong>Long burning:</strong> No more waste. Created for last long.</li>
    </ul>
  </div>

  
    `;
    }
    description_section.innerHTML = "";
    description_section.innerHTML = description_content;
  }
}

// collect product quantity

// Function to retrieve the value of a cookie by its name
function getCookie(name) {
  const cookies = document.cookie.split(";");
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith(name + "=")) {
      return cookie.substring(name.length + 1);
    }
  }
  return null;
}

// Get the value of the "myCookie" cookie and display it
if (getCookie("productQuantity") || getCookie("productQuantity") === 0) {
  const myCookieValue = getCookie("productQuantity");
  const quantityIncrement = document.querySelector(".qnt-increment");
  const quantityDecrement = document.querySelector(".qnt-decrement");
  const quantityDisplay = document.querySelector(".qnt-display");

  function increaseQuantity() {
    if (myCookieValue > parseFloat(quantityDisplay.textContent)) {
      quantityDisplay.innerHTML = parseFloat(quantityDisplay.textContent) + 1;
    }
  }
  if (quantityIncrement) {
    quantityIncrement.addEventListener("click", increaseQuantity);
  }
  function decreaseQuantity() {
    if (myCookieValue && parseFloat(quantityDisplay.textContent) > 1) {
      quantityDisplay.innerHTML = parseFloat(quantityDisplay.textContent) - 1;
    }
  }
  if (quantityDecrement)
    quantityDecrement.addEventListener("click", decreaseQuantity);
}

// pass info to cart.php
const prouctName = document.querySelector(".product_name");
const product_qnt = document.querySelector(".qnt-display");
let cart_collection = [];
window.addEventListener("load", load_cart);

function load_cart() {
  const load_cart_info = localStorage.getItem("cart_info");
  console.log(localStorage.getItem("cart_info"));
  if (!load_cart_info) {
    cart_collection = [];
  } else {
    console.log(cart_collection);
    cart_collection = JSON.parse(load_cart_info);
    console.log(cart_collection);
    let cleanedArray = cart_collection.map(([productName, quantity]) => [
      productName.trim(),
      quantity.trim(),
    ]);
    document.cookie = "js_var_value = " + cleanedArray;
    console.log(document.cookie);
  }
}

function push_to_cart() {
  let temporary_cart_info_container = [];
  let is_in_cart = false;
  temporary_cart_info_container.push(
    prouctName.textContent.trim(),
    product_qnt.textContent.trim()
  );
  for (let i = 0; i < cart_collection.length; i++) {
    if (cart_collection[i].includes(temporary_cart_info_container[0])) {
      is_in_cart = true;
      cart_collection[i][1] =
        Number(cart_collection[i][1]) +
        Number(temporary_cart_info_container[1]);
      break;
    } else {
      is_in_cart = false;
    }
  }
  if (!is_in_cart) {
    cart_collection.push(temporary_cart_info_container);
  }
  let cleanedArray = cart_collection.map(([productName, quantity]) => [
    productName.trim(),
    quantity.trim(),
  ]);
  localStorage.setItem("cart_info", JSON.stringify(cleanedArray));
  console.log(localStorage.getItem("cart_info"));
  console.log(cart_collection);
  document.cookie = "js_var_value = " + cleanedArray;
}

// cart qnt adjustment
const cartProductPrice = document.querySelectorAll(".cart-product-price");
const cartDisplay = document.querySelectorAll(".cart-qnt-display");
const cartIncrement = document.querySelectorAll(".cart-qnt-increment");
const cartDecrement = document.querySelectorAll(".cart-qnt-decrement");
const cartProductTotalPrice = document.querySelectorAll(
  ".cart-product-total-price"
);
cartIncrement.forEach((incrementor, index) => {
  incrementor.onclick = () => {
    cartDisplay[index].innerHTML = parseInt(cartDisplay[index].innerHTML) + 1;
    cartProductTotalPrice[index].innerHTML =
      parseFloat(cartProductPrice[index].innerHTML) *
      parseInt(cartDisplay[index].innerHTML);
    updateCart();
  };
});
cartDecrement.forEach((decrementor, index) => {
  decrementor.onclick = () => {
    if (parseInt(cartDisplay[index].innerHTML) > 1)
      cartDisplay[index].innerHTML = parseInt(cartDisplay[index].innerHTML) - 1;
    cartProductTotalPrice[index].innerHTML =
      parseFloat(cartProductPrice[index].innerHTML) *
      parseInt(cartDisplay[index].innerHTML);
    updateCart();
  };
});

function updateCart() {
  cartDisplay.forEach((qnt, index) => {
    cart_collection[index][1] = qnt.innerHTML;
  });
  let cleanedArray = cart_collection.map(([productName, quantity]) => [
    productName.trim(),
    quantity.trim(),
  ]);

  localStorage.setItem("cart_info", JSON.stringify(cleanedArray));
  document.cookie = "js_var_value = " + cleanedArray;
  console.log(cart_collection);
  load_cart();
}
