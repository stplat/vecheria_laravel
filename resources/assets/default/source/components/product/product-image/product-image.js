import 'blowup/lib/blowup';

$(document).ready(function () {
  if ($('.product-image__showcase img').length) {
    const showcase = document.querySelector('.product-image__showcase img');
    const preview = document.querySelector('.product-image__preview');
    const perviewButton = preview.querySelectorAll('li');

    /*if (document.querySelectorAll('.no-touch').length) {
      $(showcase).blowup({
        "width": 270,
        "height": 270
      });
    }*/

    [...perviewButton].forEach((button) => {
      button.addEventListener('click', function (e) {
        showcase.src = this.querySelector('img').src;

        if (!document.querySelector('.no-touch')) return;
        $(showcase).blowup({
          "width": 270,
          "height": 270
        });
        e.preventDefault();
      });
    });
  }
});