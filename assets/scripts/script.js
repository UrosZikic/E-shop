"use strict";
const body = document.querySelector("body");

const cart_amount = document.querySelector(".cart-amount");

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
const prouctName = document.querySelectorAll(".product_name");
const product_qnt = document.querySelectorAll(".qnt-display");
let cart_collection = [];
window.addEventListener("load", load_cart);

function load_cart() {
  const load_cart_info = localStorage.getItem("cart_info");
  cart_amount.innerHTML = load_cart_info.length;

  if (!load_cart_info) {
    cart_collection = [];
  } else {
    cart_collection = JSON.parse(load_cart_info);

    let cleanedArray = cart_collection.map(([productName, quantity]) => [
      productName.trim(),
      typeof quantity === "string" ? quantity.trim() : quantity,
    ]);
    document.cookie = "js_var_value = " + cleanedArray;
    cart_amount.innerHTML = cleanedArray.length;
  }
}

function push_to_cart(id, qnt_validation, transition_animation) {
  let temporary_cart_info_container = [];
  let is_in_cart = false;
  let qnt_determiner;

  if (transition_animation == true) {
    const push_success = document.querySelectorAll(".success-mark")[id - 1];
    push_success.classList.add("regain_opacity");
    setTimeout(() => {
      push_success.classList.remove("regain_opacity");
    }, 1000);
  }

  if (qnt_validation) {
    qnt_determiner = qnt_validation
      ? 1
      : product_qnt[id - 1].textContent.trim();
    temporary_cart_info_container.push(
      prouctName[id - 1].textContent.trim(),
      qnt_determiner
    );
  } else {
    temporary_cart_info_container.push(
      prouctName[0].textContent.trim(),
      product_qnt[0].textContent.trim()
    );
  }
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
    typeof quantity === "string" ? quantity.trim() : quantity,
  ]);
  localStorage.setItem("cart_info", JSON.stringify(cleanedArray));
  document.cookie = "js_var_value = " + cleanedArray;
  cart_amount.innerHTML = cleanedArray.length;
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
    const productName = document
      .querySelectorAll(".cart-product-name")
      [index].innerHTML.trim();
    const displayIndex = cart_collection.findIndex(
      (item) => item[0] === productName
    );

    if (cartDisplay[displayIndex].innerHTML < 20) {
      cartDisplay[displayIndex].innerHTML =
        parseInt(cartDisplay[displayIndex].innerHTML) + 1;
    }

    cartProductTotalPrice[displayIndex].innerHTML =
      parseFloat(cartProductPrice[displayIndex].innerHTML) *
      parseInt(cartDisplay[displayIndex].innerHTML);

    updateCart();
  };
});

cartDecrement.forEach((decrementor, index) => {
  decrementor.onclick = () => {
    const productName = document
      .querySelectorAll(".cart-product-name")
      [index].innerHTML.trim();
    const displayIndex = cart_collection.findIndex(
      (item) => item[0] === productName
    );

    if (parseInt(cartDisplay[displayIndex].innerHTML) > 1) {
      cartDisplay[displayIndex].innerHTML =
        parseInt(cartDisplay[displayIndex].innerHTML) - 1;
    }

    cartProductTotalPrice[displayIndex].innerHTML =
      parseFloat(cartProductPrice[displayIndex].innerHTML) *
      parseInt(cartDisplay[displayIndex].innerHTML);

    updateCart();
  };
});

function updateCart() {
  cart_collection.forEach(([productName, quantity], index) => {
    const displayIndex = Array.from(
      document.querySelectorAll(".cart-product-name")
    ).findIndex((item) => item.innerHTML.trim() === productName);

    if (displayIndex !== -1) {
      const qnt = cartDisplay[displayIndex].innerHTML.trim();
      cart_collection[index][1] = qnt.trim();
    }
  });

  let cleanedArray = cart_collection.map(([productName, quantity]) => [
    productName.trim(),
    quantity.trim(),
  ]);

  localStorage.setItem("cart_info", JSON.stringify(cleanedArray));
  document.cookie = "js_var_value = " + cleanedArray;
  load_cart();
  get_total_price();
}

//remove from cart functionality
document.querySelectorAll(".remove_product_btn").forEach((item) => {
  item.onclick = () => {
    let current_cart = JSON.parse(localStorage.getItem("cart_info"));

    // Find the closest parent container that holds product information
    const productContainer = item.closest(".cart_product_container");

    // Get the product name from the container
    const current_product_name = productContainer
      .querySelector(".cart-product-name")
      .innerHTML.trim();

    // Filter out the product with the matching name
    cart_collection = current_cart.filter(
      (item) => item[0] !== current_product_name
    );

    // Remove the product container from the DOM
    productContainer.parentNode.removeChild(productContainer);

    // Update storage and reload cart
    localStorage.setItem("cart_info", JSON.stringify(cart_collection));
    document.cookie = "js_var_value = " + cart_collection;
    load_cart();
    cart_amount.innerHTML = cart_collection.length;
    updateCart();
  };
});

// get the total price of all products combined

const total_price_sum = document.querySelector(".total_price_sum")
  ? document.querySelector(".total_price_sum")
  : null;

!total_price_sum
  ? null
  : document.querySelector(".checkout_page")
  ? null
  : get_total_price();

// total_price_sum ? get_total_price() : null;

function get_total_price() {
  load_cart();
  let total_price_sum_value = 0;
  if (document.querySelectorAll("cart_product_container")) {
    document.querySelector(".checkout_btn_styles").classList.remove("disabled");

    const total_product_price = document.querySelectorAll(
      ".cart-product-total-price"
    );
    total_product_price.forEach((total_price) => {
      total_price_sum_value += Number(total_price.innerHTML);
    });
    total_price_sum.innerHTML = total_price_sum_value.toFixed(2);
    const save_total_price = total_price_sum.innerHTML;
    document.cookie = "total_price = " + save_total_price;
  } else {
    total_price_sum.innerHTML = 0;
  }
}
