import './product-image/product-image';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.product')) {
    const product = document.querySelector('.product');
    const id = product.id;
    const button = product.querySelector('.button');
    const token = document.querySelector('meta[name="csrf-token"]');

    const alert = document.createElement('div');
    alert.className = 'product__alert';
    alert.innerText = 'Товар в корзине';

    button.addEventListener('click', function (e) {
      axios.post('/cart/addSession?id=' + id, {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token.content
        }
      }).then(res => {
        console.log(res);
        const cart = document.querySelector('.header-cart__body span span');
        cart.innerText = res.data;

        document.querySelector('.product__button').append(alert);
        button.remove();

      }).catch(
        error => console.log(error));
      e.preventDefault();
    });
  }
});

