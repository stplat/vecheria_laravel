import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
  const selects = document.querySelectorAll('.cart-item__number select');
  const token = document.querySelector('meta[name="csrf-token"]');

  selects.forEach((select) => {
    const option = select.querySelector('option[selected="selected"]');
    select.value = option.value;

    const id = select.closest('.cart-item').id;

    select.addEventListener('change', function () {
      const count = this.value;

      axios.post('/cart/addSession?id=' + id + '&count=' + count, {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token.content,
        },
      }).then(res => {

        const cart = document.querySelector('.header-cart__body span span');
        cart.innerText = res.data.cart_count;

        const cartItems = res.data.items;

        [...cartItems].forEach((item) => {
          if (item.id === id) {
            document.querySelector(`.cart-item[id="${id}"] .cart-item__total`).innerText = item.total;
          }
        });
      }).catch(
        error => console.log(error));
    });
  });

  const delButtons = document.querySelectorAll('.cart-item__remove');

  delButtons.forEach((delButton) => {
    delButton.addEventListener('click', function (e) {
      const id = delButton.closest('.cart-item').id;

      axios.post('/cart/removeSession?id=' + id, {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token.content,
        },
      }).then(res => {
        const cart = document.querySelector('.header-cart__body span span');
        cart.innerText = res.data.cart_count;

        this.closest('.cart-item').remove();

        if (!document.querySelector('.cart-item')) {
          document.querySelector('.cart').innerHTML = '<div class="cart__empty">Ваша корзина покупок пуста.</div>';
          console.log('asd')
        }

      }).catch(
        error => console.log(error));

      e.preventDefault();
    });
  });


});