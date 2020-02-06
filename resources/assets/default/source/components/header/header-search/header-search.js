import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.js-search') !== null) {
    const token = document.head.querySelector('meta[name="csrf-token"]');

    const pageBtns = document.querySelectorAll('.pagination');
    const perPageBtn = document.querySelector('.catalog__select select');

    function pageCurrent() {
      return document.querySelector('.pagination li.active span') ? document.querySelector('.pagination li.active span').innerText : 1;
    }

    function perPageCurrent() {
      return perPageBtn.value;
    }

    perPageBtn.addEventListener('change', function () {

    });

    [...pageBtns].forEach((el) => {
      el.addEventListener('click', function (e) {
        if (e.target.nodeName === 'A') {
          const page = e.target.href.slice(e.target.href.lastIndexOf('?page=') + 6);
          axiosGetItems(page, perPageCurrent(), sortCurrent());
        }
        e.preventDefault();
      });
    });

  }
});