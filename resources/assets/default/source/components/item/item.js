document.addEventListener('DOMContentLoaded', () => {
  const names = document.querySelectorAll('.item__name a');

  [...names].forEach((el) => {
    el.addEventListener('mouseenter', (e) => {
      e.target.closest('.item__name').style.overflow = 'visible';
    });

    el.addEventListener('mouseleave', (e) => {
      e.target.closest('.item__name').style.overflow = 'hidden';
    });
  });
});
