"use strict";
const body = document.querySelector("body");
let calculate_id;

const original_body_width = body.offsetWidth;

function calculate_product_id_load() {
  if (body.offsetWidth <= 1023 && body.offsetWidth >= 600) {
    calculate_id = 2;
  } else if (body.offsetWidth < 600 && body.offsetWidth >= 480) {
    calculate_id = 1;
  } else if (body.offsetWidth < 480) {
    calculate_id = 0;
  } else {
    calculate_id = 3;
  }
  return calculate_id;
}

function calculate_product_id_resize() {
  if (original_body_width > 1023) {
    calculate_id = 3;
  } else if (original_body_width <= 1023 && original_body_width >= 600) {
    calculate_id = 2;
  } else if (original_body_width < 600 && original_body_width >= 480) {
    calculate_id = 1;
  } else {
    calculate_id = 0;
  }
  return calculate_id;
}

window.addEventListener("load", calculate_product_id_load);

window.addEventListener("resize", calculate_product_id_resize);

const cart_amount = document.querySelector(".cart-amount");

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
      <li><strong>Long burning:</strong> No more waste. Created to last long.</li>
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

  const increaseQuantity = function () {
    if (myCookieValue > parseFloat(quantityDisplay.textContent)) {
      quantityDisplay.innerHTML = parseFloat(quantityDisplay.textContent) + 1;
    }
  };
  if (quantityIncrement) {
    quantityIncrement.addEventListener("click", increaseQuantity);
  }
  const decreaseQuantity = function () {
    if (myCookieValue && parseFloat(quantityDisplay.textContent) > 1) {
      quantityDisplay.innerHTML = parseFloat(quantityDisplay.textContent) - 1;
    }
  };
  if (quantityDecrement)
    quantityDecrement.addEventListener("click", decreaseQuantity);
}

// pass info to cart.php
const prouctName = document.querySelectorAll(".product_name");
const product_qnt = document.querySelectorAll(".qnt-display");
let cart_collection = [];
window.addEventListener("load", load_cart);

function load_cart(callback) {
  const load_cart_info = localStorage.getItem("cart_info");

  cart_amount.innerHTML = cart_collection.length;

  if (!load_cart_info) {
    cart_collection = [];
  } else {
    // cart_collection = JSON.parse(localStorage.getItem("cart_info"));
    const test = JSON.parse(localStorage.getItem("cart_info"));
    cart_collection = test;

    let cleanedArray = cart_collection.map(([productName, quantity]) => [
      productName.trim(),
      typeof quantity === "string" ? quantity.trim() : quantity,
    ]);

    document.cookie = "js_var_value = " + cleanedArray;

    cart_amount.innerHTML = cleanedArray.length;

    if (typeof callback === "function") {
      callback();
    }
  }
}

function push_to_cart(
  id,
  qnt_validation,
  transition_animation,
  total_qnt,
  product_name,
  product_type
) {
  let temporary_cart_info_container = [];
  let is_in_cart = false;
  let qnt_determiner;

  //
  //   if (transition_animation == true) {
  //     const push_success = document.querySelectorAll(".success-mark")[calculate_id + id];
  //     push_success.classList.add("regain_opacity");
  //     setTimeout(() => {
  //       push_success.classList.remove("regain_opacity");
  //     }, 1000);
  //   }

  if (qnt_validation) {
    const validate_category = window.location.href.includes("category");
    const validate_device = window.location.href.includes("device");
    const validate_price = window.location.href.includes("price");

    if (validate_category || validate_device || validate_price) {
      let target_id = "";
      for (let i = 0; i < prouctName.length; i++) {
        if (product_name === prouctName[i].innerHTML.trim()) {
          target_id = i;
          break;
        }
      }
      console.log(target_id, "is id");
      qnt_determiner = qnt_validation
        ? 1
        : product_qnt[target_id].textContent.trim();
      qnt_determiner <= 20 ? qnt_determiner : 20;
      temporary_cart_info_container.push(
        prouctName[target_id].textContent.trim(),
        qnt_determiner
      );
    } else {
      if (product_type === "regular") {
        console.log(prouctName[0]);
        if (id > 12 && id <= 24) {
          qnt_determiner = qnt_validation
            ? 1
            : product_qnt[id - 13].textContent.trim();
          qnt_determiner <= 20 ? qnt_determiner : 20;
          temporary_cart_info_container.push(
            prouctName[id - 13].textContent.trim(),
            qnt_determiner
          );
        } else if (id > 24 && id <= 36) {
          qnt_determiner = qnt_validation
            ? 1
            : product_qnt[id - 25].textContent.trim();
          qnt_determiner <= 20 ? qnt_determiner : 20;
          temporary_cart_info_container.push(
            prouctName[id - 25].textContent.trim(),
            qnt_determiner
          );
        } else {
          qnt_determiner = qnt_validation
            ? 1
            : product_qnt[id - 1].textContent.trim();
          qnt_determiner <= 20 ? qnt_determiner : 20;
          temporary_cart_info_container.push(
            prouctName[id - 1].textContent.trim(),
            qnt_determiner
          );
        }
      } else {
        qnt_determiner = qnt_validation
          ? 1
          : product_qnt[calculate_id + id].textContent.trim();
        qnt_determiner <= 20 ? qnt_determiner : 20;
        temporary_cart_info_container.push(
          prouctName[calculate_id + id].textContent.trim(),
          qnt_determiner
        );
      }
    }
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
          Number(temporary_cart_info_container[1]) <=
        total_qnt
          ? Number(cart_collection[i][1]) +
            Number(temporary_cart_info_container[1])
          : total_qnt;
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
  // document.cookie = "js_var_value=" + encodeURIComponent(cleanedArray) + "; HttpOnly; Secure; SameSite=Lax";
  cart_amount.innerHTML = cleanedArray.length;

  if (document.querySelector(".product_success_overlay")) {
    document
      .querySelector(".product_success_overlay")
      .classList.remove("product_success_overlay_none");
  }
  setTimeout(() => {
    if (document.querySelector(".product_success")) {
      document
        .querySelector(".product_success")
        .classList.remove("product_success_initial");
    }
  }, 100);
}

if (document.querySelector(".proceed_to_cart")) {
  document.querySelector(".proceed_to_cart").onclick = () => {
    window.location.href = "cart.php";
  };
}

if (document.querySelector(".keep_shopping")) {
  document.querySelector(".keep_shopping").onclick = () => {
    document
      .querySelector(".product_success")
      .classList.add("product_success_initial");

    setTimeout(() => {
      document
        .querySelector(".product_success_overlay")
        .classList.add("product_success_overlay_none");
    }, 500);
  };
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

  // CLEANED ARRAY JE PROBLEM

  localStorage.setItem("cart_info", JSON.stringify(cleanedArray));

  document.cookie = "js_var_value = " + cleanedArray;

  // document.cookie = "js_var_value=" + encodeURIComponent(cleanedArray) + "; HttpOnly; Secure; SameSite=Lax";
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
    // document.cookie = "js_var_value=" + encodeURIComponent(cart_collection) + "; HttpOnly; Secure; SameSite=Lax";

    // updateCart();
    load_cart();

    cart_amount.innerHTML = cart_collection.length;

    if (
      localStorage.getItem("cart_info") === null ||
      localStorage.getItem("cart_info").length <= 2
    ) {
      window.location.href = "index.php";
    }
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

if (document.querySelector(".success_msg")) {
  const success_msg = document.querySelector(".success_msg");
  setTimeout(() => {
    success_msg.style.display = "none";
  }, 2000);
}

if (document.querySelector("#order_form")) {
  const order_form = document.querySelector("#order_form");
  order_form.onsubmit = () => {
    localStorage.clear();
    total_price_sum.innerHTML = 0;
    document.cookie = "reset_cart =" + true;
  };
}

if (document.querySelector(".checkout_forward")) {
  const checkout_forward = document.querySelector(".checkout_forward");
  checkout_forward.onclick = () => {
    if (
      localStorage.getItem("cart_info") !== null &&
      localStorage.getItem("cart_info").length > 2
    ) {
      window.location.href = "checkout.php";
    } else {
      return null;
    }
  };
}
