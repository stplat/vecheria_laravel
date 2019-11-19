import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.js-ordering-next')) {
    const buttonNext = document.querySelectorAll('.js-ordering-next');
    const buttonPrev = document.querySelectorAll('.js-ordering-prev');
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const container = document.querySelector('.cart__content');
    const cartContainers = document.querySelectorAll('[data-container]');
    const cartSteps = document.querySelectorAll('[data-step]');
    let currentStep = Number(document.querySelector('.is-active[data-step]').dataset.step);

    function checkStep() {
      [...cartContainers].forEach((el) => {
        el.classList.add('hidden');
        if (Number(el.dataset.container) === currentStep) {
          el.classList.remove('hidden');
        }
      });

      if (currentStep === 1) {

      }

      [...cartSteps].forEach((el) => {
        el.classList.remove('is-active');
        if (Number(el.dataset.step) === currentStep) {
          el.classList.add('is-active');
        }
      });
    }

    /*
    *  Продолжить оформление
    * */
    [...buttonNext].forEach((button) => {
      button.addEventListener('click', (e) => {
        currentStep !== 3 ? currentStep = currentStep + 1 : currentStep = 3;

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

        e.preventDefault();
      });
    });


    /*
    *  Вернуться назад
    * */
    [...buttonPrev].forEach((button) => {
      button.addEventListener('click', (e) => {
        currentStep !== 1 ? currentStep = currentStep - 1 : currentStep = 1;

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

        e.preventDefault();
      });
    });
  }
});

