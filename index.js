/*Carousel Javascript*/
function rotate() {
  var lastChild = $('.slider div:last-child').clone();
  $('.slider div:last-child').remove();
  $('.slider').prepend(lastChild);
  lastChild.addClass('firstSlide'); // Fix adding class
}

//Rotation na every 4 seconds
window.setInterval(function() {
  rotate();
}, 4000);
