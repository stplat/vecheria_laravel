
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" href="/" itemprop="item"><span itemprop="name">Православный интернет-магазин «ВЕЧЕРИЯ»</span><meta itemprop="position" content="1" /></a></li>
      <li>Корзина</li>
    </ul>
    <div class="title">
      <div class="title__wrap">
        <h1>Корзина покупок</h1>
      </div>
    </div>
  <div class="cart js-cart">@if ($cart_count == 0)
    <div class="cart__empty">Ваша корзина покупок пуста.</div>@else
    <div class="cart__col">@if ($cart_step == 1)
      <div class="cart__items" data-container="1">@foreach ($items as $key => $item)
<div class="cart-item" id="{{$item->product_id}}" data-article="{{$item->article}}">
  <div class="cart-item__col">
    <div class="cart-item__image"><img src="/images/items/{{$item->slug}}.jpg" alt="{{$item->name}}" title="{{$item->name}}"></div>
  </div>
  <div class="cart-item__col">
    <div class="cart-item__title">Наименование:</div>
    <div class="cart-item__name"><a href="/catalog/{{$item->category_slug}}/{{$item->slug}}">{{$item->name}}</a></div>
    <div class="cart-item__price">{{$item->price}}</div>
  </div>
  <div class="cart-item__col">
    <div class="cart-item__title">Количество:</div>
    <div class="cart-item__number">
      <select name="count">
        @for ($i = 1; $i < 11; $i++)
        @if ($item->count == $i)
        <option value="{{$i}}" selected="selected">{{$i}}</option>@else
        <option value="{{$i}}">{{$i}}</option>@endif
        @endfor
      </select>
    </div>
  </div>
  <div class="cart-item__col">
    <div class="cart-item__title">Сумма:</div>
    <div class="cart-item__total">{{$item->total}}</div>
  </div><span class="cart-item__remove"></span>
</div>@endforeach

      </div>@else
      <div class="cart__items hidden" data-container="1">@foreach ($items as $key => $item)
<div class="cart-item" id="{{$item->product_id}}" data-article="{{$item->article}}">
  <div class="cart-item__col">
    <div class="cart-item__image"><img src="/images/items/{{$item->slug}}.jpg" alt="{{$item->name}}" title="{{$item->name}}"></div>
  </div>
  <div class="cart-item__col">
    <div class="cart-item__title">Наименование:</div>
    <div class="cart-item__name"><a href="/catalog/{{$item->category_slug}}/{{$item->slug}}">{{$item->name}}</a></div>
    <div class="cart-item__price">{{$item->price}}</div>
  </div>
  <div class="cart-item__col">
    <div class="cart-item__title">Количество:</div>
    <div class="cart-item__number">
      <select name="count">
        @for ($i = 1; $i < 11; $i++)
        @if ($item->count == $i)
        <option value="{{$i}}" selected="selected">{{$i}}</option>@else
        <option value="{{$i}}">{{$i}}</option>@endif
        @endfor
      </select>
    </div>
  </div>
  <div class="cart-item__col">
    <div class="cart-item__title">Сумма:</div>
    <div class="cart-item__total">{{$item->total}}</div>
  </div><span class="cart-item__remove"></span>
</div>@endforeach

      </div>@endif
      @if ($cart_step == 2)
            <div class="cart-ordering" data-container="2">
              <div class="cart-ordering__title">Оформление заказа</div>
              <form class="cart-ordering__form" id="ordering">
                <div class="cart-ordering__field">
                  <label for="name">ФИО <span>обязательное поле</span></label>
                  <input id="name" name="name" placeholder="Пример: Иванов Иван Иванович"><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <label for="phone">Телефон <span>обязательное поле</span></label>
                  <input id="phone" name="phone" type="tel" placeholder="Пример: 8 (495) 000-00-00"><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <div>Доставка <span>обязательное поле</span></div>
                  <ul>
                    <li class="cart-ordering__radio">
                      <input id="shipping_1" name="shipping" type="radio" value="300">
                      <label for="shipping_1">в пределах МКАД (300 руб.)</label>
                    </li>
                    <li class="cart-ordering__radio">
                      <input id="shipping_2" name="shipping" type="radio" value="доставка за МКАД (цена договорная)">
                      <label for="shipping_2">за МКАД (цена договорная)</label>
                    </li>
                  </ul><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <label for="address">Адрес</label>
                  <input id="address" name="address" placeholder="Пример: г. Москва, ул. Советская д. 1, кв. 2"><span class="empty"></span>
                </div>
                <div class="cart-ordering__field">
                  <label for="email">Email <span>для отправки заказа</span></label>
                  <input id="email" name="email" placeholder="Пример: example@example.ru"><span>Для отправки заказа</span>
                </div>
                <div class="cart-ordering__field">
                  <label for="comment">Комментарий</label>
                  <textarea id="comment" name="comment" placeholder="Пример: Во дворе злая собака!"></textarea><span class="empty"></span>
                </div>
                <div class="cart-ordering__field">
                  <label for="promo">Промокод <span>для активации скидки</span></label>
                  <input id="promo" name="promo" placeholder="Пример: AB9DE"><span>Для активации скидки</span>
                </div>
              </form>
            </div>@else
            <div class="cart-ordering hidden" data-container="2">
              <div class="cart-ordering__title">Оформление заказа</div>
              <form class="cart-ordering__form" id="ordering">
                <div class="cart-ordering__field">
                  <label for="name">ФИО <span>обязательное поле</span></label>
                  <input id="name" name="name" placeholder="Пример: Иванов Иван Иванович"><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <label for="phone">Телефон <span>обязательное поле</span></label>
                  <input id="phone" name="phone" type="tel" placeholder="Пример: 8 (495) 000-00-00"><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <div>Доставка <span>обязательное поле</span></div>
                  <ul>
                    <li class="cart-ordering__radio">
                      <input id="shipping_1" name="shipping" type="radio" value="300">
                      <label for="shipping_1">в пределах МКАД (300 руб.)</label>
                    </li>
                    <li class="cart-ordering__radio">
                      <input id="shipping_2" name="shipping" type="radio" value="доставка за МКАД (цена договорная)">
                      <label for="shipping_2">за МКАД (цена договорная)</label>
                    </li>
                  </ul><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <label for="address">Адрес</label>
                  <input id="address" name="address" placeholder="Пример: г. Москва, ул. Советская д. 1, кв. 2"><span class="empty"></span>
                </div>
                <div class="cart-ordering__field">
                  <label for="email">Email <span>для отправки заказа</span></label>
                  <input id="email" name="email" placeholder="Пример: example@example.ru"><span>Для отправки заказа</span>
                </div>
                <div class="cart-ordering__field">
                  <label for="comment">Комментарий</label>
                  <textarea id="comment" name="comment" placeholder="Пример: Во дворе злая собака!"></textarea><span class="empty"></span>
                </div>
                <div class="cart-ordering__field">
                  <label for="promo">Промокод <span>для активации скидки</span></label>
                  <input id="promo" name="promo" placeholder="Пример: AB9DE"><span>Для активации скидки</span>
                </div>
              </form>
            </div>@endif
      @if ($cart_step == 3)
            <div class="cart-ordering" data-container="3">
              <div class="cart-ordering__title">Информация о заказе</div>
              <ul class="cart-ordering__list">
                <li><span>Контактное лицо:</span><span class="js-name"></span></li>
                <li><span>Телефон:</span><span class="js-phone"></span></li>
                <li><span>Способ доставки:</span><span class="js-shipping"></span></li>
                <li><span>Адрес доставки:</span><span class="js-address">не указано</span></li>
                <li><span>Электронная почта:</span><span class="js-email">не указано</span></li>
                <li><span>Комментарий:</span><span class="js-comment">не указано</span></li>
                <li class="is-important"><span>Стоимость изделий:</span><span class="is-price js-price">{{$cart_total}}</span></li>
                <li><span>Стоимость доставки:</span><span class="is-price js-shipping-price"></span></li>
                <li class="is-important"><span>Скидка по промокоду:</span><span class="is-price js-discount">{{$cart_total}}</span></li>
                <li class="is-important"><span>Общая стоимость покупки:</span><span class="is-price js-total-price">{{$cart_total}}</span></li>
              </ul>
            </div>@else
            <div class="cart-ordering hidden" data-container="3">
              <div class="cart-ordering__title">Информация о заказе</div>
              <ul class="cart-ordering__list">
                <li><span>Контактное лицо:</span><span class="js-name"></span></li>
                <li><span>Телефон:</span><span class="js-phone"></span></li>
                <li><span>Способ доставки:</span><span class="js-shipping"></span></li>
                <li><span>Адрес доставки:</span><span class="js-address">не указано</span></li>
                <li><span>Электронная почта:</span><span class="js-email">не указано</span></li>
                <li><span>Комментарий:</span><span class="js-comment">не указано</span></li>
                <li class="is-important"><span>Стоимость изделий:</span><span class="is-price js-price">{{$cart_total}}</span></li>
                <li><span>Стоимость доставки:</span><span class="is-price js-shipping-price"></span></li>
                <li class="is-important"><span>Скидка по промокоду:</span><span class="is-price js-discount">{{$cart_total}}</span></li>
                <li class="is-important"><span>Общая стоимость покупки:</span><span class="is-price js-total-price">{{$cart_total}}</span></li>
              </ul>
            </div>@endif
    </div>
    <div class="cart__col">
      <div class="cart-nav">
        <ul class="cart-nav__list">@if ($cart_step == 1)
          <li class="is-active" data-step="1">Список покупок</li>@else
          <li data-step="1">Список покупок</li>@endif
          @if ($cart_step == 2)
          <li class="is-active" data-step="2">Оформление заказа</li>@else
          <li data-step="2">Оформление заказа</li>@endif
          @if ($cart_step == 3)
          <li class="is-active" data-step="3">Информация о заказе</li>@else
          <li data-step="3">Информация о заказе</li>@endif
        </ul>
      </div>
    </div>
    <div class="cart__col">
      <div class="cart-nav__panel">
        <div class="cart-nav__total">
          <p>{{$cart_total}}</p>
        </div>@if ($cart_step == 1)
        <div class="cart-nav__button"><a class="button button--red js-ordering-next" href="">Начать оформление</a></div>
        <div class="cart-nav__link"><span class="js-ordering-prev hidden">Вернуться</span></div>@elseif ($cart_step == 2)
        <div class="cart-nav__button"><a class="button button--red js-ordering-next" href="">Продолжить</a></div>
        <div class="cart-nav__link"><span class="js-ordering-prev">Вернуться</span></div>@elseif ($cart_step == 3)
        <div class="cart-nav__button"><a class="button button--red js-ordering-next" href="">Оформить</a></div>
        <div class="cart-nav__link"><span class="js-ordering-prev">Вернуться</span></div>@endif
      </div>
    </div>@endif
  </div>
</div>@endsection