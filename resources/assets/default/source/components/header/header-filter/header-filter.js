function raf(fn) {
  window.requestAnimationFrame(() => {
    window.requestAnimationFrame(() => {
      fn();
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelectorAll('.js-catalog').length) {
    const page = document.querySelector('body');
    const button = document.querySelector('.header-filter');
    const filter = document.querySelector('.filter');

    button.classList.add('is-flex');

    button.addEventListener('click', function (e) {
      const flag = this.classList.contains('is-active');

      if (!flag) {
        button.classList.add('is-active');
        filter.classList.add('is-display');
        page.style.overflow = 'hidden';
        raf(() => {
          filter.classList.add('is-active');
        });
      } else {
        filter.classList.remove('is-active');
        filter.addEventListener('transitionend', () => {
          filter.classList.remove('is-display');
          page.style.overflow = 'visible';
          button.classList.remove('is-active');
        }, {once: true});
      }

      e.preventDefault();
    });

    document.addEventListener('click', (e) => {
      if (!e.target.closest('.header__filter') && !e.target.closest('.filter')) {
        if (button.classList.contains('is-active')) {
          filter.classList.remove('is-active');
          filter.addEventListener('transitionend', () => {
            filter.classList.remove('is-display');
            button.classList.remove('is-active');

            if (!e.target.closest('.header__bar')) {
              page.style.overflow = 'visible';
            }

          }, {once: true});

        }
        e.stopPropagation();
      }
    });

    window.addEventListener('resize', () => {
      if (window.matchMedia('(min-width: 769px)').matches) {
        if (button.classList.contains('is-active')) {
          filter.classList.remove('is-active');
          filter.addEventListener('transitionend', () => {
            filter.classList.remove('is-display');
            page.style.overflow = 'visible';
            button.classList.remove('is-active');
          }, {once: true});
        }
      }
    });
  }
});