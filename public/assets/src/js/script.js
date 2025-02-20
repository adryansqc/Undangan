// Hamburger
const hamburger = document.querySelector('#hamburger');
const hamburger2 = document.querySelector('#hamburger2');
const hamburger3 = document.querySelector('#hamburger3');

hamburger.addEventListener('click', function() {
    hamburger.classList.toggle('hamburger-active');
});

// Close hamburger
hamburger2.addEventListener('click', function(e) {
    hamburger.classList.remove('hamburger-active');
});

hamburger3.addEventListener('click', function(e) {
    hamburger.classList.remove('hamburger-active');
});