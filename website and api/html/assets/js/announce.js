function mouseOver() {
  alert("Hello! I am an alert box!!");
  this.getElementsByClassName("accounce_demo_post_content")[0].style.display = "inline-grid";
}
function mouseOut() {
  alert("Hello! I am an alert box!!");
  this.getElementsByClassName("accounce_demo_post_content")[0].style.display = "none";
}
window.onload = function() {
  var closest = document.getElementsByClassName("accounce_demo_post");
  for (var i in closest) {
    if (closest.hasOwnProperty(i)){
      alert("k");
      closest[i].addEventListener("mouseover", mouseOver);
      closest[i].addEventListener("mouseout", mouseOut);
    }
  }
};
