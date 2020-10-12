
"use strict";

let searchButton = document.getElementById("open-search");
let searchInp = document.querySelector(".nav-search");
let hideBar = document.getElementById("hideable-bar");

searchButton.addEventListener("click", (e) => {
  console.log(searchInp);
  searchInp.classList.toggle("hidden");
  let radius = searchInp.classList.contains("hidden");
  searchButton.setAttribute("type", "submit");
  searchButton.style.borderRadius = radius ? "0 12px 12px 0" : "12px";
});

let course = document.querySelector(".course");
const coursesWrapper = document.querySelector(
  ".horizontal-scroll.top-courses-content"
);

for (let index = 0; index < 10; index++) {
  let courseClone = course.cloneNode(true);
  coursesWrapper.appendChild(courseClone);
}

coursesWrapper.addEventListener("mousewheel", function (e) {
  e.preventDefault();
  if (e.deltaY > 0) coursesWrapper.scrollLeft += 25;
  else coursesWrapper.scrollLeft -= 25;
});


let isDown = false;
let startX;
let scrollLeft;
// Thanks for this piece of code to https://codepen.io/toddwebdev/pen/yExKoj
coursesWrapper.addEventListener('mousedown', (e) => {
  isDown = true;
  coursesWrapper.classList.add('active');
  startX = e.pageX - coursesWrapper.offsetLeft;
  scrollLeft = coursesWrapper.scrollLeft;
});
coursesWrapper.addEventListener('mouseleave', () => {
  isDown = false;
  coursesWrapper.classList.remove('active');
});
coursesWrapper.addEventListener('mouseup', () => {
  isDown = false;
  coursesWrapper.classList.remove('active');
});
coursesWrapper.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX - coursesWrapper.offsetLeft;
  const walk = (x - startX) * 3; //scroll-fast
  coursesWrapper.scrollLeft = scrollLeft - walk;
//   console.log(walk);
});