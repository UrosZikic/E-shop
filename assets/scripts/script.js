"use strict";

const head_image = document.querySelector(".head_image");
const responsive_nav = document.querySelector(".normal-dismiss");
const body = document.querySelector("body");
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

const description_section = document.querySelector(".description-section");
let description_content;

window.addEventListener("load", description_layout_check);
window.addEventListener("resize", description_layout_check);

function description_layout_check() {
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

  <img src="assets/images/image.png" alt="scented candles">
   
   `;
  } else {
    description_content = `
    <div>
  <h2 style="text-align: center;">Clean and fragrant soy wax
      <p>Made for your home and for your wellness</p>
    </h2>

    <img src="assets/images/image.png" alt="scented candles" style="width: 80%; height: 80%">

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
