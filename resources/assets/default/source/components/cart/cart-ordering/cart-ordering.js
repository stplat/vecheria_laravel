import Inputmask from 'inputmask';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.js-ordering-next')) {
    const buttonNext = document.querySelector('.js-ordering-next');
    const buttonPrev = document.querySelector('.js-ordering-prev');
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const container = document.querySelector('.cart');
    const total = document.querySelector('.cart-nav__total p');
    const cartContainers = document.querySelectorAll('[data-container]');
    const cartSteps = document.querySelectorAll('[data-step]');
    const form = document.querySelector('#ordering');
    const name = form.name;
    const phone = form.phone;
    const maskPhone = new Inputmask('9 (999) 999-99-99', {
      showMaskOnHover: false,
      showMaskOnFocus: false,
    });
    const shipping = form.shipping;
    const address = form.address;
    const email = form.email;
    const comment = form.comment;
    const promo = form.promo;
    promo.value = '';
    let promoFlag = true;
    let promoDiscount = '';
    const maskPromo = new Inputmask('A|9A|9A|9A|9A|9', {
      showMaskOnHover: false,
      showMaskOnFocus: false,
      placeholder: '',
    });
    let orderFlag = false;
    let currentStep = Number(document.querySelector('.is-active[data-step]').dataset.step);

    maskPhone.mask(phone);
    maskPromo.mask(promo);
    /*
   *  Продолжить оформление
   * */
    buttonNext.addEventListener('click', (e) => {
      currentStep !== 3 ? currentStep = currentStep + 1 : currentStep = 3;
      checkStep();
      e.preventDefault();
    });

    /*
    *  Вернуться назад
    * */
    buttonPrev.addEventListener('click', (e) => {
      currentStep !== 1 ? currentStep = currentStep - 1 : currentStep = 1;
      orderFlag = false;
      checkStep();
      e.preventDefault();
    });

    promo.oninput = promo.onpaste = function () {
      promoDiscount = 0;

      if (promo.value !== '' && promo.value.length !== 5) {
        promo.previousElementSibling.querySelector('span').classList.add('is-invalid');
        promo.nextElementSibling.classList.add('is-invalid');
        promo.previousElementSibling.querySelector('span').classList.remove('is-valid');
        promo.nextElementSibling.classList.remove('is-valid');
        promo.classList.add('is-invalid');
        promo.classList.remove('is-valid');
        promoFlag = false;
      } else if (promo.value.length === 5) {
        document.querySelector('.js-cart').classList.add('is-loaded');

        const params = JSON.stringify({
          promo: promo.value,
        });

        axios.post('/checkPromo', params, {
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token,
          },
        }).then(res => {
          if (res.data.check) {
            promo.previousElementSibling.querySelector('span').classList.remove('is-invalid');
            promo.nextElementSibling.classList.remove('is-invalid');
            promo.previousElementSibling.querySelector('span').classList.add('is-valid');
            promo.nextElementSibling.classList.add('is-valid');
            promo.classList.remove('is-invalid');
            promo.classList.add('is-valid');
            promoFlag = true;
            promoDiscount = res.data.discount;
          } else {
            promo.previousElementSibling.querySelector('span').classList.add('is-invalid');
            promo.nextElementSibling.classList.add('is-invalid');
            promo.previousElementSibling.querySelector('span').classList.remove('is-valid');
            promo.nextElementSibling.classList.remove('is-valid');
            promo.classList.add('is-invalid');
            promo.classList.remove('is-valid');
            promoFlag = false;
          }
          document.querySelector('.js-cart').classList.remove('is-loaded');
        }).catch((error) => {
          document.querySelector('.js-cart').classList.remove('is-loaded');
          console.log(error);
        });
      } else if (promo.value === '') {
        promo.previousElementSibling.querySelector('span').classList.remove('is-invalid');
        promo.nextElementSibling.classList.remove('is-invalid');
        promo.previousElementSibling.querySelector('span').classList.remove('is-valid');
        promo.nextElementSibling.classList.remove('is-valid');
        promo.classList.remove('is-invalid');
        promo.classList.remove('is-valid');
        promoFlag = true;
      }
    };

    function formValidate() {
      let flag = true;

      if (!name.value) {
        name.previousElementSibling.querySelector('span').classList.add('is-invalid');
        name.nextElementSibling.classList.add('is-invalid');
        name.previousElementSibling.querySelector('span').classList.remove('is-valid');
        name.nextElementSibling.classList.remove('is-valid');
        name.classList.add('is-invalid');
        name.classList.remove('is-valid');
        flag = false;
      } else {
        name.previousElementSibling.querySelector('span').classList.remove('is-invalid');
        name.nextElementSibling.classList.remove('is-invalid');
        name.previousElementSibling.querySelector('span').classList.add('is-valid');
        name.nextElementSibling.classList.add('is-valid');
        name.classList.remove('is-invalid');
        name.classList.add('is-valid');
      }

      if (phone.value === '' || phone.value.indexOf('_') > 0) {
        if (phone) {
          phone.previousElementSibling.querySelector('span').classList.add('is-invalid');
          phone.nextElementSibling.classList.add('is-invalid');
          phone.previousElementSibling.querySelector('span').classList.remove('is-valid');
          phone.nextElementSibling.classList.remove('is-valid');
          phone.classList.add('is-invalid');
          phone.classList.remove('is-valid');
          flag = false;
        }
      } else if (phone.value !== '' && phone.value.indexOf('_') < 0) {
        phone.previousElementSibling.querySelector('span').classList.remove('is-invalid');
        phone.nextElementSibling.classList.remove('is-invalid');
        phone.previousElementSibling.querySelector('span').classList.add('is-valid');
        phone.nextElementSibling.classList.add('is-valid');
        phone.classList.remove('is-invalid');
        phone.classList.add('is-valid');
      }

      let radioFlag = false;

      [...shipping].forEach((radio) => {
        radio.checked ? radioFlag = true : '';
      });

      if (radioFlag) {
        shipping[0].closest('ul').previousElementSibling.querySelector('span').classList.remove('is-invalid');
        shipping[0].closest('ul').nextElementSibling.classList.remove('is-invalid');
        shipping[0].closest('ul').previousElementSibling.querySelector('span').classList.add('is-valid');
        shipping[0].closest('ul').nextElementSibling.classList.add('is-valid');
      } else {
        shipping[0].closest('ul').previousElementSibling.querySelector('span').classList.add('is-invalid');
        shipping[0].closest('ul').nextElementSibling.classList.add('is-invalid');
        shipping[0].closest('ul').previousElementSibling.querySelector('span').classList.remove('is-valid');
        shipping[0].closest('ul').nextElementSibling.classList.remove('is-valid');
        flag = false;
      }

      if (email.value !== '' && email.value.match(/.+@.+\..+/i) === null) {
        email.previousElementSibling.querySelector('span').classList.add('is-invalid');
        email.nextElementSibling.classList.add('is-invalid');
        email.previousElementSibling.querySelector('span').classList.remove('is-valid');
        email.nextElementSibling.classList.remove('is-valid');
        email.classList.add('is-invalid');
        email.classList.remove('is-valid');
        flag = false;
      } else if (email.value !== '' && email.value.match(/.+@.+\..+/i) !== null) {
        email.previousElementSibling.querySelector('span').classList.remove('is-invalid');
        email.nextElementSibling.classList.remove('is-invalid');
        email.previousElementSibling.querySelector('span').classList.add('is-valid');
        email.nextElementSibling.classList.add('is-valid');
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');
      } else if (email.value === '') {
        email.previousElementSibling.querySelector('span').classList.remove('is-invalid');
        email.nextElementSibling.classList.remove('is-invalid');
        email.previousElementSibling.querySelector('span').classList.remove('is-valid');
        email.nextElementSibling.classList.remove('is-valid');
        email.classList.remove('is-invalid');
        email.classList.remove('is-valid');
      }

      if (!promoFlag) {
        flag = false;
      }

      return flag;
    }

    function checkStep() {

      if (total.innerText >= 4000) {
        document.querySelector('#shipping_1').nextElementSibling.innerHTML = 'в пределах МКАД <span class="green">(бесплатно)</span>';
        document.querySelector('#shipping_1').value = 'доставка в пределах МКАД (бесплатно)';
      } else {
        document.querySelector('#shipping_1').nextElementSibling.innerHTML = 'в пределах МКАД <span class="red">(300 руб.)</span>';
        document.querySelector('#shipping_1').value = 'доставка в пределах МКАД (300 руб.)';
      }

      if (orderFlag) {
        const itemsHTML = document.querySelectorAll('.cart-item');
        let items = '';

        [...itemsHTML].forEach(item => {
          const article = item.dataset.article;
          const anchor = item.querySelector('.cart-item__name').innerText;
          items += '«' + anchor + '» - артикул: ' + article + ';<br/> ';
        });

        const params = JSON.stringify({
          name: form.name.value,
          phone: form.phone.value,
          shipping: form.shipping.value,
          address: form.address.value,
          email: form.email.value,
          comment: form.comment.value,
          promo: form.promo.value,
          items: items,
          price: document.querySelector('.js-price').innerText,
          discount: document.querySelector('.js-discount').innerText,
          total: document.querySelector('.js-total-price').innerText,
        });

        document.querySelector('.js-cart').classList.add('is-loaded');

        axios.post('/ordering', params, {
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token,
          },
        }).then(res => {
          const col_1 = document.querySelectorAll('.cart__col')[1];
          const col_2 = document.querySelectorAll('.cart__col')[2];
          const alert = document.createElement('div');
          col_1.classList.add('hidden');
          col_2.classList.add('hidden');
          container.style.display = 'block';

          alert.className = 'cart-ordering__success';
          alert.innerHTML = '<p> Ваш заказ успешно оформлен!<p> Благодарим Вас за покупку в нашем интернет-магазине.</p>';
          container.prepend(alert);
          document.querySelector('.js-cart').classList.remove('is-loaded');
        }).catch((error) => {
          console.log(error);
          document.querySelector('.js-cart').classList.remove('is-loaded');
        });
      }

      if (currentStep === 1) {
        total.style.display = 'block';
        buttonPrev.classList.add('hidden');
        buttonNext.innerText = 'Начать оформление';
        handler();
      }

      if (currentStep === 2) {
        total.style.display = 'block';
        buttonPrev.classList.remove('hidden');
        buttonNext.innerText = 'Продолжить';
        handler();
      }

      if (currentStep === 3) {
        if (formValidate()) {
          total.style.display = 'none';
          buttonPrev.classList.remove('hidden');
          buttonNext.innerText = 'Оформить';
          handler();

          const jsName = document.querySelector('.js-name');
          const jsPhone = document.querySelector('.js-phone');
          const jsShipping = document.querySelector('.js-shipping');
          const jsShippingPrice = document.querySelector('.js-shipping-price');
          const jsAddress = document.querySelector('.js-address');
          const jsEmail = document.querySelector('.js-email');
          const jsComment = document.querySelector('.js-comment');
          const jsPrice = document.querySelector('.js-price');
          const jsDiscount = document.querySelector('.js-discount');
          const jsTotalPrice = document.querySelector('.js-total-price');

          jsName.innerText = name.value;
          jsPhone.innerText = phone.value;
          [...shipping].forEach((radio) => {
            if (radio.checked) {
              if (radio.id === 'shipping_1') {
                if (total.innerText >= 4000) {
                  jsShipping.innerHTML = 'в пределах МКАД <span class="green">(бесплатно)</span>';
                  jsShippingPrice.innerText = 0;
                } else {
                  jsShippingPrice.innerText = 300;
                  jsShipping.innerHTML = 'в пределах МКАД <span class="red">(300 руб.)</span>';
                }
                !jsTotalPrice.classList.contains('is-price') ? jsTotalPrice.classList.add('is-price') : '';
                !jsShippingPrice.classList.contains('is-price') ? jsShippingPrice.classList.add('is-price') : '';
              } else if (radio.id === 'shipping_2') {
                jsShipping.innerHTML = 'доставка за МКАД';
                jsShippingPrice.innerText = 'договорная';
                jsShippingPrice.classList.remove('is-price');
              }
            }
          });

          jsAddress.innerText = address.value ? address.value : 'не указано';
          jsEmail.innerText = email.value ? email.value : 'не указано';
          jsComment.innerText = comment.value ? comment.value : 'не указано';
          jsDiscount.innerText = Math.ceil(Number(jsPrice.innerText) * promoDiscount / 100);
          if (jsShippingPrice.innerText === 'договорная') {
            jsTotalPrice.innerText = Number(jsPrice.innerText) - Number(jsDiscount.innerText) + ' руб. + доставка';
            jsTotalPrice.classList.remove('is-price');
          } else {
            jsTotalPrice.innerText = Number(jsPrice.innerText) - Number(jsDiscount.innerText) + Number(jsShippingPrice.innerText);
          }

          orderFlag = true;

        } else {
          currentStep = currentStep - 1;
          orderFlag = false;
        }
      }

      function handler() {
        [...cartContainers].forEach((el) => {
          el.classList.add('hidden');
          if (Number(el.dataset.container) === currentStep) {
            el.classList.remove('hidden');
          }
        });

        [...cartSteps].forEach((el) => {
          el.classList.remove('is-active');
          if (Number(el.dataset.step) === currentStep) {
            el.classList.add('is-active');
          }
        });
      }
    }
  }
});

