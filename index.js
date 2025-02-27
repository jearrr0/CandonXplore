document.querySelector('.menu-icon').addEventListener('click', function() {
  document.querySelector('nav').classList.toggle('active');
});

/* Carousel JavaScript */
let slideIndex = 0;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  let i;
  let slides = document.querySelectorAll('.slider img');
  if (n >= slides.length) { slideIndex = 0 }
  if (n < 0) { slideIndex = slides.length - 1 }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none';
  }
  slides[slideIndex].style.display = 'block';
}

// Auto slide
setInterval(function() {
  plusSlides(1);
}, 4000);
