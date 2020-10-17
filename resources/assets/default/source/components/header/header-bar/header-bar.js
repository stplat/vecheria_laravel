function raf(fn) {
  window.requestAnimationFrame(() => {
    window.requestAnimationFrame(() => {
      fn();
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const page = document.querySelector('body');
  const button = document.querySelector('.header-bar');
  const nav = document.querySelector('.header-nav');
  const subButton = document.querySelector('.header-nav__link--cat');
  const subNav = document.querySelector('.header-nav__sub');
  const subNavLinks = document.querySelectorAll('.header-nav__sub-link');
  const subNavGroups = document.querySelectorAll('.header-nav__group');
  const back = document.querySelector('.header-nav__link--back');

  button.addEventListener('click', function (e) {
    const flag = this.classList.contains('is-active');

    if (!flag) {
      button.classList.add('is-active');
      nav.classList.add('is-display');
      page.style.overflow = 'hidden';
      raf(() => {
        nav.classList.add('is-active');

        [...subNavGroups].forEach(item => {
          item.style.height = item.clientHeight + 'px';
          item.classList.add('is-deactive');
        })
      });
    } else {
      nav.classList.remove('is-active');
      nav.addEventListener('transitionend', () => {
        nav.classList.remove('is-display');
        page.style.overflow = 'visible';
        button.classList.remove('is-active');
      }, {once: true});
    }

    e.preventDefault();
  });

  document.addEventListener('click', (e) => {
    if (!e.target.closest('.header-nav__sub') && !e.target.classList.contains('header-nav__link')
      && !e.target.closest('.header__bar')) {
      if (button.classList.contains('is-active')) {
        nav.classList.remove('is-active');
        nav.addEventListener('transitionend', () => {
          nav.classList.remove('is-display');
          button.classList.remove('is-active');

          if (!e.target.closest('.header__filter')) {
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
        nav.classList.remove('is-active');
        nav.addEventListener('transitionend', () => {
          nav.classList.remove('is-display');
          page.style.overflow = 'visible';
          button.classList.remove('is-active');
        }, {once: true});
      }

      if (subButton.classList.contains('is-active')) {
        subNav.classList.remove('is-active');
        subNav.addEventListener('transitionend', () => {
          subNav.classList.remove('is-display');
          subButton.classList.remove('is-active');
        }, {once: true});
      }
    }
  });

  subButton.addEventListener('click', function(e) {
    const flag = this.classList.contains('is-active');

    if (!flag) {
      subButton.classList.add('is-active');
      subNav.classList.add('is-display');
      nav.classList.add('is-sub');
      raf(() => {
        subNav.classList.add('is-active');
      });
    } else {
      subNav.classList.remove('is-active');
      subNav.addEventListener('transitionend', () => {
        subNav.classList.remove('is-display');
        subButton.classList.remove('is-active');
        nav.classList.remove('is-sub');
      }, { once: true });
    }

    e.preventDefault();
    e.stopPropagation();
  });

  back.addEventListener('click', function(e) {
    nav.classList.remove('is-sub');

    nav.addEventListener('transitionend', () => {
      subNav.classList.remove('is-active');
      subNav.classList.remove('is-display');
      subButton.classList.remove('is-active');
    }, { once: true });

    e.preventDefault();
  });

  [...subNavLinks].forEach(subNavLink => {
    subNavLink.addEventListener('click', function(e) {
      const flag = this.classList.contains('is-active');
      const subNavGroup = this.nextElementSibling;

      if (!flag) {
        subNavLink.classList.add('is-active');
        subNavGroup.classList.add('is-display');
        raf(() => {
          subNavGroup.classList.remove('is-deactive');
        });
      } else {
        subNavGroup.classList.add('is-deactive');
        subNavGroup.addEventListener('transitionend', () => {
          subNavGroup.classList.remove('is-display');
          subNavLink.classList.remove('is-active');
        }, { once: true });
      }

      e.preventDefault();
      e.stopPropagation();
    });
  });
});
