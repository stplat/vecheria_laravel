import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {

  if (document.querySelector('.catalog') !== null) {

    const token = document.head.querySelector('meta[name="csrf-token"]');
    const subcategoryPath = document.querySelector('.filter-section__link.is-active').getAttribute('href');
    const subcategory = subcategoryPath.slice(subcategoryPath.lastIndexOf('/') + 1);

    const pageBtns = document.querySelectorAll('.pagination');
    const perPageBtn = document.querySelector('.catalog__select select');
    const sort = document.querySelectorAll('[name="orderby"]');

    perPageBtn.value = '24';
    document.querySelector('[value="asc"]').checked = 'checked';

    function pageCurrent() {
      return document.querySelector('.pagination li.active span') ? document.querySelector('.pagination li.active span').innerText : 1;
    }

    function perPageCurrent() {
      return perPageBtn.value;
    }

    function sortCurrent() {
      let value = '';
      [...sort].forEach((el) => {
        if (el.checked) {
          value = el.value;
        }
      });

      return value;
    }

    function axiosGetItems(page, perPage, sort) {
      const url = `/catalog/${subcategory}/?page=${page}&per_page=${perPage}&orderby=${sort}`;

      axios.get(url, {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token.content
        }
      }).then(res => {
        const items = res.data.items.data;
        const itemsCount = res.data.items.to;
        const itemCountAll = res.data.items.total;
        const pagination = res.data.pagination;
        let item = '';

        console.log(res);

        items.forEach((el) => {
          item += `
            <div class="item item--3">
              <div class="item__sign"><p>${el.manufactured}</p></div>
              <div class="item__article">${el.article}</div>
              <div class="item__image"><a href="/catalog/${el.subcategory_plug}/${el.plug}"><img src="/images/items/${el.image_path}" alt="${el.name}" title="${el.name}"></a></div>
              <div class="item__name"><a href="/catalog/${el.subcategory_plug}/${el.plug}">${el.name}</a></div>
              <div class="item__price"><p>${el.price}</p></div>
              <div class="item__button"><a class="button button--small" href="/catalog/${el.subcategory_plug}/${el.plug}">Подробнее</a>
              </div>
            </div>
        `.replace(/ +/g, ' ').trim();
        });

        document.querySelector('.item__container').innerHTML = item;
        document.querySelector('.catalog__total p').innerHTML = `показано товаров: ${itemsCount} из ${itemCountAll} ед.`;
        document.querySelector('.pagination') ? document.querySelector('.pagination').innerHTML = pagination : '';

      }).catch(
        error => console.log(error));
    }

    perPageBtn.addEventListener('change', function () {
      axiosGetItems(pageCurrent(), this.value, sortCurrent());
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

    [...sort].forEach((el) => {
      el.addEventListener('click', function (e) {
        axiosGetItems(pageCurrent(), perPageCurrent(), this.value);
      });
    });
  }
});