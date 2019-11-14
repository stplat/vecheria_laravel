import Inputmask from 'inputmask';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
  /*
  *  Всплывашка
  * */

  if (document.querySelector('.js-button-callback')) {
    handlerPopup('js-button-callback', 'js-popup-callback');
  }

  /*
  *  Форма обратного звонка*
  * */
  const callbackForm = document.querySelector('#callback');
  const token = document.head.querySelector('meta[name="csrf-token"]');

  if (callbackForm) {
    const phoneInput = callbackForm.elements.phone;
    const nameInput = callbackForm.elements.name;
    const maskPhone = new Inputmask('9 (999) 999-99-99', {
      showMaskOnHover: false,
      showMaskOnFocus: false,
    });

    maskPhone.mask(phoneInput);

    callbackForm.addEventListener('submit', (e) => {
      let flag = false;

      if (nameInput.value !== '') {
        if (nameInput.closest('.popup__input')) {
          nameInput.closest('.popup__input').classList.remove('is-invalid');
          nameInput.closest('.popup__input').classList.add('is-valid');
          flag = true;
        }
      }

      if (phoneInput.value !== '' && phoneInput.value.indexOf('_') < 0) {
        if (phoneInput.closest('.popup__input')) {
          phoneInput.closest('.popup__input').classList.remove('is-invalid');
          phoneInput.closest('.popup__input').classList.add('is-valid');
          flag = true;
        }
      }

      if (nameInput.value === '') {
        if (nameInput.closest('.popup__input')) {
          nameInput.closest('.popup__input').classList.add('is-invalid');
          nameInput.closest('.popup__input').classList.remove('is-valid');
          flag = false;
        }
      }

      if (phoneInput.value === '' || phoneInput.value.indexOf('_') > 0) {
        if (phoneInput.closest('.popup__input')) {
          phoneInput.closest('.popup__input').classList.add('is-invalid');
          phoneInput.closest('.popup__input').classList.remove('is-valid');
          flag = false;
        }
      }

      if (flag) {
        const body = document.querySelector('.popup__body');
        const data = JSON.stringify({
          name: nameInput.value,
          phone: phoneInput.value,
        });

        body.classList.add('is-loaded');

        axios.post('/callback', data, {
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token.content,
          },
        }).then((res) => {
          const success = document.createElement('div');

          console.log(res);

          success.class = 'popup__success';
          success.innerText = 'Заявка успешно отправлена!';

          body.classList.remove('is-loaded');
          body.classList.add('is-success');
          body.innerHTML = '';
          body.append(success);
        }).catch((error) => {
          body.classList.remove('is-loaded');
          console.log(error);
        });
      }
      e.preventDefault();
    });
  }
});

function raf(fn) {
  window.requestAnimationFrame(() => {
    window.requestAnimationFrame(() => {
      fn();
    });
  });
}

function handlerPopup(classButton, classPopup) {
  const page = document.querySelector('body');
  const button = document.querySelector(`.${classButton}`);
  const popup = document.querySelector(`.${classPopup}`);
  const close = document.querySelector('.popup__close');

  button.addEventListener('click', (e) => {
    popup.style.display = 'block';
    page.style.overflow = 'hidden';
    raf(() => {
      popup.classList.add('is-active');
    });
    e.preventDefault();
  });

  popup.addEventListener('click', (e) => {
    if (e.target.closest('.popup__container') === null) {
      popup.classList.remove('is-active');
      popup.addEventListener('transitionend', function handler() {
        popup.style.display = 'none';
        page.style.overflow = 'visible';
        popup.removeEventListener('transitionend', handler);
      });
    }
  });

  close.addEventListener('click', (e) => {
    popup.classList.remove('is-active');
    popup.addEventListener('transitionend', function handler() {
      popup.style.display = 'none';
      page.style.overflow = 'visible';
      popup.removeEventListener('transitionend', handler);
    });
    e.preventDefault();
  });
}