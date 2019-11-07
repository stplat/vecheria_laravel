import axios from 'axios';

document.addEventListener('DOMContentLoaded', function () {
  if (document.querySelector('.product')) {
    const product = document.querySelector('.product');
    const id = product.id;
    const button = product.querySelector('.button');
    const token = document.head.querySelector('meta[name="csrf-token"]');

    button.addEventListener('click', function (e) {
      axios.post('/cart/addSession?id=5', {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token.content
        }
      }).then(res => {
        console.log(res);
      }).catch(
        error => console.log(error));
      e.preventDefault();
    });

    console.log(button)
  }
});