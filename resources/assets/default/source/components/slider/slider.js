import Swiper from 'swiper';

document.addEventListener('DOMContentLoaded', () => {
  const swiperInstace = new Swiper('.js-slider', {
    spaceBetween: 10,
    slidesPerView: 1,
    autoplay: {
      delay: 5000,
      disableOnInteraction: true,
    },
    breakpoints: {
      1024: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      320: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
    },
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });

  document.querySelector('.js-slider').addEventListener('mouseenter', () => {
    swiperInstace.autoplay.stop();
  });

  document.querySelector('.js-slider').addEventListener('mouseleave', () => {
    swiperInstace.autoplay.start();
  });
});
