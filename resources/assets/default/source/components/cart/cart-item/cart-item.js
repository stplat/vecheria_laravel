import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
  const selects = document.querySelectorAll('.cart-item__number select');
  const token = document.querySelector('meta[name="csrf-token"]');

  selects.forEach((select) => {
    const option = select.querySelector('option[selected="selected"]');
    const id = select.closest('.cart-item').id;

    select.value = option.value;

    /*
    *  Выбор количества товаров
    * */
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
        const cartItems = res.data.items;
        const total = document.querySelector('.cart-nav__total p');
        const jsPrice = document.querySelector('.js-price');

        cart.innerText = res.data.cart_count;
        total.innerText = res.data.cart_total;
        jsPrice.innerText = res.data.cart_total;

        [...cartItems].forEach((item) => {
          if (item.id === id) {
            document.querySelector(`.cart-item[id="${id}"] .cart-item__total`).innerText = item.total;
          }
        });
      }).catch(
        error => console.log(error));
    });
  });

  /*
  *  Удаление товара
  * */
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
        const total = document.querySelector('.cart-nav__total p');

        this.closest('.cart-item').remove();

        cart.innerText = res.data.cart_count;
        total.innerText = res.data.cart_total;

        if (!document.querySelector('.cart-item')) {
          document.querySelector('.cart').innerHTML = '<div class="cart__empty">Ваша корзина покупок пуста.</div>';
        }

      }).catch(
        error => console.log(error));

      e.preventDefault();
    });
  });


});