import './product-image/product-image';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.product')) {
    const product = document.querySelector('.product');
    const id = product.id;
    const price = product.querySelector('.product__price p').innerText;
    const count = 1;
    const button = product.querySelector('.button');
    const token = document.querySelector('meta[name="csrf-token"]');

    const alert = document.createElement('div');
    alert.className = 'product__alert';
    alert.innerText = 'Товар в корзине';

    if (button)
      button.addEventListener('click', function (e) {
        axios.post('/cart/addSession?id=' + id + '&price=' + price + '&count=' + count, {
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token.content,
          },
        }).then(res => {
          const cart = document.querySelector('.header-cart__body span span');
          cart.innerText = res.data.cart_count;

          document.querySelector('.product__button').append(alert);
          button.remove();

        }).catch(
          error => console.log(error));
        e.preventDefault();
      });
  }
});

