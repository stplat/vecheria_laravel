document.addEventListener('DOMContentLoaded', () => {

  if (document.querySelector('.filter-slide-box') !== null) {
    const box = document.querySelectorAll('.filter-slide-box');
    const active = document.querySelector('.filter-slide-box__link.is-active');

    active.closest('.filter-slide-box__body').classList.add('is-active');

    [...box].forEach(function (el) {
      el.addEventListener('click', function (e) {
        const button = e.target;
        const body = e.target.nextElementSibling;

        if (button.classList.contains('filter-slide-box__head')) {
          if (!body.classList.contains('is-active')) {
            body.classList.add('is-active');
            button.classList.add('is-active');
          } else {
            body.classList.remove('is-active');
            button.classList.remove('is-active');
          }
        }
      });
    });
  }

});