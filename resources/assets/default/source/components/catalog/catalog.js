import axios from 'axios';


document.addEventListener('DOMContentLoaded', () => {

  if (document.querySelector('.js-catalog') !== null) {
    const token = document.head.querySelector('meta[name="csrf-token"]');
    const container = document.querySelector('.item__container');

    /*
    * Определяем Action для Ajax запроса
    *
    * */
    const pathCategory = document.querySelector('.filter-slide-box__link.is-active').getAttribute('href'),
      slugCategory = pathCategory.slice(pathCategory.lastIndexOf('/') + 1);

    /*
    * Обрабатываем форму для отправки Сортировки
    *
    * */
    const form = document.querySelector('#sort');
    const limit = form.limit;
    const order = form.orderby;
    let query = '';

    /* Значения по умолчанию */
    limit.value = '24';
    order.querySelector('[value="asc"]').selected = 'selected';
    query = `${slugCategory}?limit=${limit.value}&orderby=${order.value}`;

    /*
    * Имитируем лимит товаров на странице, прячем все элементы
    *
    * */
    [...container.querySelectorAll('.item')].forEach((item, i) => {
      if (i >= 24) {
        item.remove();
      }
    });

    /*
    * Обрабатываем событие Select-ов
    *
    * */
    limit.addEventListener('change', function () {
      query = `${slugCategory}?limit=${this.value}&orderby=${order.value}`;
      counter = Number(limit.value);
      getItems(query);
    });

    order.addEventListener('change', function () {
      query = `${slugCategory}?limit=${limit.value}&orderby=${this.value}`;
      getItems(query);
    });

    /*
    * Определяем координаты item-container-а для скрола
    *
    * */
    const moreItems = document.querySelector('.catalog__more');
    let counter = Number(limit.value);

    moreItems.addEventListener('click', (e) => {
      counter += Number(limit.value);
      query = `${slugCategory}?limit=${counter}&orderby=${order.value}`;
      getItems(query);
      e.preventDefault();
    });

    /*
    * Функция-обработчик для Ajax-запросов
    *
    * */
    function getItems(query) {
      document.querySelector('.js-catalog').classList.add('is-loaded');
      axios.get(query, {
        headers: {
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': token.content
        }
      }).then(res => {
        const items = res.data.items;

        let item = '';

        items.forEach((el) => {
          item += `
            <div class="item item--3">
              <div class="item__sign"><p>${el.manufacturer}</p></div>
              <div class="item__article">${el.article}</div>
              <div class="item__image"><a href="/catalog/${el.category_slug}/${el.slug}"><picture><source srcset="/images/items/${el.slug}-thumb.webp" type="image/webp"><img src="/images/items/${el.slug}-thumb.jpg" alt="${el.name}" title="${el.name}"></picture></a></div>
              <div class="item__name"><a href="/catalog/${el.category_slug}/${el.slug}">${el.name}</a></div>
              <div class="item__price"><p>${el.price}</p></div>
              <div class="item__button"><a class="button button--small" href="/catalog/${el.category_slug}/${el.slug}">Подробнее</a>
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
  }
});