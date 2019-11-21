import Inputmask from 'inputmask';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.js-ordering-next')) {
    const buttonNext = document.querySelector('.js-ordering-next');
    const buttonPrev = document.querySelector('.js-ordering-prev');
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const container = document.querySelector('.cart__content');
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
        name.nextElementSibling.classList.add('is-invalid');
        name.nextElementSibling.classList.remove('is-valid');
        name.classList.add('is-invalid');
        name.classList.remove('is-valid');
        flag = false;
      } else {
        name.nextElementSibling.classList.remove('is-invalid');
        name.nextElementSibling.classList.add('is-valid');
        name.classList.remove('is-invalid');
        name.classList.add('is-valid');
      }

      if (phone.value === '' || phone.value.indexOf('_') > 0) {
        if (phone) {
          phone.nextElementSibling.classList.add('is-invalid');
          phone.nextElementSibling.classList.remove('is-valid');
          phone.classList.add('is-invalid');
          phone.classList.remove('is-valid');
          flag = false;
        }
      } else if (phone.value !== '' && phone.value.indexOf('_') < 0) {
        phone.nextElementSibling.classList.remove('is-invalid');
        phone.nextElementSibling.classList.add('is-valid');
        phone.classList.remove('is-invalid');
        phone.classList.add('is-valid');
      }

      let radioFlag = false;

      [...shipping].forEach((radio) => {
        radio.checked ? radioFlag = true : '';
      });

      if (radioFlag) {
        shipping[0].closest('ul').nextElementSibling.classList.remove('is-invalid');
        shipping[0].closest('ul').nextElementSibling.classList.add('is-valid');
      } else {
        shipping[0].closest('ul').nextElementSibling.classList.add('is-invalid');
        shipping[0].closest('ul').nextElementSibling.classList.remove('is-valid');
        flag = false;
      }

      if (email.value !== '' && email.value.match(/.+@.+\..+/i) === null) {
        email.classList.add('is-invalid');
        email.classList.remove('is-valid');
        flag = false;
      } else if (email.value !== '' && email.value.match(/.+@.+\..+/i) !== null) {
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');
      } else if (email.value === '') {
        email.classList.remove('is-invalid');
        email.classList.remove('is-valid');
      }

      return flag;
    }

    function checkStep() {

      if (orderFlag) {
        const aside = document.querySelector('.cart__aside');
        aside.classList.add('hidden');

        const alert = document.createElement('div');
        alert.className = 'cart-ordering__success';
        alert.innerHTML = '<p> Ваш заказ успешно оформлен!<p> Благодарим Вас за покупку в нашем интернет-магазине.</p>';
        container.prepend(alert);
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
              jsShipping.innerText = radio.value;
              if (radio.id === 'shipping_1') {
                jsTotalPrice.innerText = Number(jsPrice.innerText) + 300;
                !jsTotalPrice.classList.contains('is-price') ? jsTotalPrice.classList.add('is-price') : '';
              } else if (radio.id === 'shipping_2') {
                jsTotalPrice.innerText = 'уточняйте у менеджера';
                jsTotalPrice.classList.remove('is-price');
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

