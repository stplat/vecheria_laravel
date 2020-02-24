import Swiper from 'swiper/js/swiper.js';

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.item__container') !== null) {
    const itemContainer = document.querySelector('.item__container');

    itemContainer.addEventListener('mouseover', function (e) {
      if (e.target.parentNode.classList.contains('item__name')) {
        e.target.closest('div').style.overflow = 'visible';
      }
    });

    itemContainer.addEventListener('mouseout', (e) => {
      if (e.target.parentNode.classList.contains('item__name')) {
        e.target.closest('div').style.overflow = 'hidden';
      }
    });
  }


  let names = '';

  if (document.querySelectorAll('.item__name a').length) {
    names = document.querySelectorAll('.item__name a');
  } else {
    names = document.querySelectorAll('.cart-item__name a');
  }

  [...names].forEach((el) => {
    el.addEventListener('mouseenter', (e) => {
      e.target.closest('div').style.overflow = 'visible';
    });

    el.addEventListener('mouseleave', (e) => {
      e.target.closest('div').style.overflow = 'hidden';
    });
  });

  if (document.querySelectorAll('.js-item-slider').length) {
    const swiperInstace_2 = new Swiper('.js-item-slider', {
      spaceBetween: 15,
      slidesPerView: 1,
      breakpoints: {
        993: {
          spaceBetween: 15,
          slidesPerView: 4
        },
        769: {
          spaceBetween: -50,
          slidesOffsetAfter: -60,
          slidesPerView: 3
        },
        500: {
          spaceBetween: -50,
          slidesOffsetAfter: -60,
          slidesPerView: 2
        },
        0: {
          spaceBetween: -50,
          slidesOffsetAfter: -60,
          slidesPerView: 1
        },
      }

    });
  }
});




