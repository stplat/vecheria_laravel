import Inputmask from "inputmask";
import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {

  const callbackForm = document.querySelector('#callback');
  const token = document.head.querySelector('meta[name="csrf-token"]');

  if (callbackForm) {
    const maskPhone = new Inputmask('9 (999) 999-99-99', {showMaskOnHover: false});
    const nameInput = callbackForm.elements.name;
    const phoneInput = callbackForm.elements.phone;

    maskPhone.mask(phoneInput);

    callbackForm.addEventListener('submit', (e) => {
      e.preventDefault();

      if (nameInput.value === '') {
        nameInput.closest('.popup__input').classList.add('is-invalid');
        return false;
      }

      if (phoneInput.value === '') {
        phoneInput.closest('.popup__input').classList.add('is-invalid');
        return false;
      }

      axios.post('/callback', {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token.content,
        },
      }).then(res => {
        console.log(res);

      }).catch(
        error => console.log(error));
    });
  }


});