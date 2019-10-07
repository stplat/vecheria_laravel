document.addEventListener('DOMContentLoaded', () => {
  const selects = document.querySelectorAll('.auto-search-select');

  [...selects].forEach((select) => {
    select.addEventListener('click', function (e) {
      if (!e.target.closest('.auto-search-select__search')) {
        //
        if (this.classList.contains('is-active')) {
          this.classList.remove('is-active');
        } else {
          [...selects].forEach((select) => {
            select.classList.remove('is-active');
          });
          this.classList.add('is-active');
        }
      }
      e.preventDefault();
    });
  });

  document.addEventListener('click', (e) => {
    if (!e.target.closest('.auto-search-select')) {
      [...selects].forEach((select) => {
        select.classList.remove('is-active');
      });
    }
  });
});

