import axios from 'axios';


document.addEventListener('DOMContentLoaded', () => {

  if (document.querySelector('.js-catalog') !== null) {
    const token = document.head.querySelector('meta[name="csrf-token"]');
    const container = document.querySelector('.item__container');
    const pathCategory = document.querySelector('.filter-slide-box__link.is-active').getAttribute('href');
    const slugCategory = pathCategory.slice(pathCategory.lastIndexOf('/') + 1);

    [...container.querySelectorAll('.item')].forEach((item, i) => {
      if (i >= 24) {
        item.style.display = 'none';
      }
    });

    function itemsMore(limit) {
      axios.get(`${slugCategory}?limit=${limit}`, {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token.content
        }
      }).then(res => {
        console.log(res);
        const items = res.data.items;

        let item = '';

        items.forEach((el) => {
          item += `
            <div class="item item--3">
              <div class="item__sign"><p>${el.manufacturer}</p></div>
              <div class="item__article">${el.article}</div>
              <div class="item__image"><a href="/${el.slug}"><picture><source srcset="/images/items/${el.slug}-thumb.webp" type="image/webp"><img src="/images/items/${el.slug}-thumb.jpg" alt="${el.name}" title="${el.name}"></picture></a></div>
              <div class="item__name"><a href="/${el.slug}">${el.name}</a></div>
              <div class="item__price"><p>${el.price}</p></div>
              <div class="item__button"><a class="button button--small" href="/${el.slug}">Подробнее</a>
              </div>
            </div>
        `.replace(/ +/g, ' ').trim();
        });

        document.querySelector('.item__container').innerHTML = item;
        document.querySelector('.js-catalog').classList.remove('is-loaded');


      }).catch((error) => {
        document.querySelector('.js-catalog').classList.remove('is-loaded');
        console.log(error);
      });
    }


    /*const token = document.head.querySelector('meta[name="csrf-token"]');
    const subcategoryPath = document.querySelector('.filter-slide-box__link.is-active').getAttribute('href');
    const subcategory = subcategoryPath.slice(subcategoryPath.lastIndexOf('/') + 1);

    const pageBtns = document.querySelectorAll('.pagination');
    const perPageBtn = document.querySelector('.catalog-select select');
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
      const url = `/${subcategory}/?page=${page}&per_page=${perPage}&orderby=${sort}`;
      document.querySelector('.js-catalog').classList.add('is-loaded');

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

        items.forEach((el) => {
          item += `
            <div class="item item--3">
              <div class="item__sign"><p>${el.manufacturer}</p></div>
              <div class="item__article">${el.article}</div>
              <div class="item__image"><a href="/${el.subcategory_slug}/${el.slug}"><picture><source srcset="/images/items/${el.slug}-thumb.webp" type="image/webp"><img src="/images/items/${el.slug}-thumb.jpg" alt="${el.name}" title="${el.name}"></picture></a></div>
              <div class="item__name"><a href="/${el.subcategory_slug}/${el.slug}">${el.name}</a></div>
              <div class="item__price"><p>${el.price}</p></div>
              <div class="item__button"><a class="button button--small" href="/${el.subcategory_slug}/${el.slug}">Подробнее</a>
              </div>
            </div>
        `.replace(/ +/g, ' ').trim();
        });

        document.querySelector('.item__container').innerHTML = item;
        document.querySelector('.catalog__total span').innerHTML = `${itemsCount} изд.`;
        document.querySelector('.pagination') ? document.querySelector('.pagination').innerHTML = pagination : '';
        document.querySelector('.js-catalog').classList.remove('is-loaded');

      }).catch((error) => {
        document.querySelector('.js-catalog').classList.remove('is-loaded');
        console.log(error);
      });
    }

    perPageBtn.addEventListener('change', function () {
      axiosGetItems(pageCurrent(), this.value, sortCurrent());
    });

    [...pageBtns].forEach((el) => {
      el.addEventListener('click', function (e) {
        if (e.target.nodeName === 'A') {
          const page = e.target.href.slice(e.target.href.lastIndexOf('?page=') + 6);
          axiosGetItems(page, perPageCurrent(), sortCurrent());

          $('html, body').animate({
            scrollTop: Number($('.catalog__title').offset().top)
          }, 600);
        }
        e.preventDefault();
      });
    });

    [...sort].forEach((el) => {
      el.addEventListener('change', function (e) {
        axiosGetItems(pageCurrent(), perPageCurrent(), this.value);
      });
    });*/
  }
});