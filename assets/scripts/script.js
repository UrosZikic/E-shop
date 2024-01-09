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
