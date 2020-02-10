document.addEventListener('DOMContentLoaded', () => {
  const up = document.querySelector('.up');

  $(window).scroll(function () {
    if ($(this).scrollTop() > 400) {
      $(up).fadeIn();
    } else {
      $(up).fadeOut();
    }
  });

  up.addEventListener('click', function (e) {
    $('html, body').animate({
      scrollTop: 0
    }, 600);

    e.preventDefault();
  });
});