document.addEventListener('DOMContentLoaded', () => {
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
});
