document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.product-desc')) {
    const tabs = document.querySelectorAll('.product-desc__tab li');
    const screens = document.querySelectorAll('.product-desc__screen');

    [...tabs].forEach((button) => {
      button.addEventListener('click', function (e) {
        const id = this.dataset.for;

        if (this.classList.contains('is-active')) return false;
        this.classList.add('is-active');

        [...tabs].forEach((tab) => {
          if (tab.dataset.for !== id) {
            tab.classList.remove('is-active');
          }
        });

        changeScreen(id);
        e.preventDefault();
      })
    });

    function changeScreen(id) {
      const screen = document.querySelector(`.product-desc__screen[data-id="${id}"]`);
      screen.style.display = 'block';

      [...screens].forEach((screen) => {
        if (screen.dataset.id !== id) {
          screen.style.display = 'none';
        }
      });
    }
  }
});