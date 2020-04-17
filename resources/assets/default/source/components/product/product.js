import './product-image/product-image';
import './product-desc/product-desc';
import {sendForm, handlerPopup} from '../popup/popup';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.product')) {
    const product = document.querySelector('.product');
    const id = product.id;
    const article = product.querySelector('.product__article').innerText;
    const itemName = product.querySelector('.product__name h1').innerText;
    const price = product.querySelector('.product__price p').innerText;
    const count = 1;
    const button = product.querySelector('.button');
    const token = document.querySelector('meta[name="csrf-token"]').content;

    /*
    *  Форма быстрой покупки*
    * */
    const buyForm = document.querySelector('#buy');
    const other = JSON.stringify({
      id: id,
      article: article,
      itemName: itemName,
      price: price
    });

    handlerPopup('js-button-buy', 'js-popup-buy');
    sendForm(buyForm, '/buy', token, other);


    /*
    *  Добавление в корзину покупок
    * */
    const alert = document.createElement('div');
    alert.className = 'product__alert';
    alert.innerText = 'Товар в корзине';

    const anchor = document.createElement('a');
    anchor.href = '/cart';
    anchor.innerText = 'Перейти в корзину';

    if (button)
      button.addEventListener('click', function (e) {
        const buttonContainer = document.querySelector('.product__button');
        const anchorContainer = document.querySelector('.product__buy');

        buttonContainer.classList.add('is-deactive');
        button.style.textTransform = 'none';
        button.innerText = 'Отправка...';

        axios.post('/cart/addSession?id=' + id + '&price=' + price + '&count=' + count, {
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token,
          },
        }).then(res => {
          const cart = document.querySelector('.header-cart__body span span');
          cart.innerText = res.data.cart_count;

          button.remove();
          anchorContainer.querySelector('span').remove();
          buttonContainer.classList.remove('is-deactive');
          buttonContainer.append(alert);
          anchorContainer.append(anchor);

        }).catch((error) => {
          buttonContainer.classList.remove('is-deactive');
          button.style.textTransform = 'uppercase';
          button.innerText = 'В корзину';
          console.log(error);
        });
        e.preventDefault();
      });
  }
});

