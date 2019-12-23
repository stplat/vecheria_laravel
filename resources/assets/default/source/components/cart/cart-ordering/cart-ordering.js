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
    let orderFlag = false;
    let currentStep = Number(document.querySelector('.is-active[data-step]').dataset.step);

    maskPhone.mask(phone);
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

    function ajaxSend(currentStep) {
      const params = JSON.stringify({
        cart_step: currentStep,
      });

      axios.post('/ordering', params, {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token,
        },
      }).then(res => {
        checkStep();
      }).catch((error) => {
        console.log(error);
      });
    }

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

        const params = JSON.stringify({
          name: form.name.value,
          phone: form.phone.value,
          shipping: form.shipping.value,
          address: form.address.value,
          email: form.email.value,
          comment: form.comment.value,
          price: document.querySelector('.js-price').innerText,
          total: document.querySelector('.js-total-price').innerText,
        });

        axios.post('/ordering', params, {
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token,
          },
        }).then(res => {
          console.log(res);
          const col_1 = document.querySelectorAll('.cart__col')[1];
          const col_2 = document.querySelectorAll('.cart__col')[2];
          const alert = document.createElement('div');
          col_1.classList.add('hidden');
          col_2.classList.add('hidden');
          container.style.display = 'block';

          alert.className = 'cart-ordering__success';
          alert.innerHTML = '<p> Ваш заказ успешно оформлен!<p> Благодарим Вас за покупку в нашем интернет-магазине.</p>';
          container.prepend(alert);
        }).catch((error) => {
          console.log(error);
        });
      }

      if (currentStep === 1) {
        buttonPrev.classList.add('hidden');
        buttonNext.innerText = 'Начать оформление';
        handler();
      }

      if (currentStep === 2) {
        buttonPrev.classList.remove('hidden');
        buttonNext.innerText = 'Продолжить';
        handler();
      }

      if (currentStep === 3) {
        if (formValidate()) {
          buttonPrev.classList.remove('hidden');
          buttonNext.innerText = 'Оформить';
          handler();

          const jsName = document.querySelector('.js-name');
          const jsPhone = document.querySelector('.js-phone');
          const jsShipping = document.querySelector('.js-shipping');
          const jsAddress = document.querySelector('.js-address');
          const jsEmail = document.querySelector('.js-email');
          const jsComment = document.querySelector('.js-comment');
          const jsPrice = document.querySelector('.js-price');
          const jsTotalPrice = document.querySelector('.js-total-price');

          jsName.innerText = name.value;
          jsPhone.innerText = phone.value;
          [...shipping].forEach((radio) => {
            if (radio.checked) {
              if (radio.id === 'shipping_1') {
                if (total.innerText >= 4000) {
                  jsTotalPrice.innerText = Number(jsPrice.innerText);
                  jsShipping.innerHTML = 'в пределах МКАД <span class="green">(бесплатно)</span>';
                } else {
                  jsTotalPrice.innerText = Number(jsPrice.innerText) + 300;
                  jsShipping.innerHTML = 'в пределах МКАД <span class="red">(300 руб.)</span>';
                }

                !jsTotalPrice.classList.contains('is-price') ? jsTotalPrice.classList.add('is-price') : '';
              } else if (radio.id === 'shipping_2') {
                jsTotalPrice.innerText = 'уточняйте у менеджера';
                jsTotalPrice.classList.remove('is-price');
                jsShipping.innerHTML = 'доставка за МКАД (цена договорная)';
              }
            }
          });
          jsAddress.innerText = address.value ? address.value : 'не указано';
          jsEmail.innerText = email.value ? email.value : 'не указано';
          jsComment.innerText = comment.value ? comment.value : 'не указано';
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

