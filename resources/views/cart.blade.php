
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li>Корзина</li>
    </ul>
    <div class="title">
      <div class="title__wrap">
        <h1>Корзина покупок</h1>
      </div>
    </div>
  <div class="cart">@if ($cart_count == 0)
    <div class="cart__empty">Ваша корзина покупок пуста.</div>@else
    <div class="cart__content">@if ($cart_step == 1)@foreach ($items as $key => $item)
<div class="cart-item" id="{{$item->id}}">
  <div class="cart-item__col">
    <div class="cart-item__image"><img src="/images/items/{{$item->image_path}}" alt="{{$item->name}}" title="{{$item->name}}"></div>
  </div>
  <div class="cart-item__col">
    <div class="cart-item__title">Наименование:</div>
    <div class="cart-item__name"><a href="/catalog/{{$item->subcategory_plug}}/{{$item->plug}}/">{{$item->name}}</a></div>
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
  </div><a class="cart-item__remove" href="" title="Удалить из корзины"></a>
</div>@endforeach
@elseif ($cart_step == 2)
            <div class="cart-ordering">
              <div class="cart-ordering__title">Оформление заказа</div>
              <form class="cart-ordering__form" id="ordering">
                <div class="cart-ordering__field">
                  <label for="name">Контактное лицо</label>
                  <input id="name" name="name" placeholder="Пример: Иванов Иван Иванович"><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <label for="phone">Телефон</label>
                  <input id="phone" name="phone" placeholder="Пример: 8 (495) 000-00-00"><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <div>Способ доставки</div>
                  <ul>
                    <li class="cart-ordering__radio">
                      <input id="shipping_1" name="shipping" type="radio">
                      <label for="shipping_1">Курьерская доставка в пределах МКАД (300 руб.)</label>
                    </li>
                    <li class="cart-ordering__radio">
                      <input id="shipping_2" name="shipping" type="radio">
                      <label for="shipping_2">Курьерская доставка за МКАД (цена договорная)</label>
                    </li>
                  </ul><span>Обязательное поле</span>
                </div>
                <div class="cart-ordering__field">
                  <label for="address">Адрес доставки</label>
                  <input id="address" name="address" placeholder="Пример: г. Москва, ул. Советская д. 1, кв. 2"><span class="empty"></span>
                </div>
                <div class="cart-ordering__field">
                  <label for="email">Электронная почта</label>
                  <input id="email" name="email" placeholder="Пример: example@example.ru"><span class="empty"></span>
                </div>
                <div class="cart-ordering__field">
                  <label for="email">Комментарий</label>
                  <textarea id="comment" name="comment" placeholder="Пример: Во дворе злая собака!"></textarea><span class="empty"></span>
                </div>
              </form>
            </div>@elseif ($cart_step == 3)
            <div class="cart-ordering">
              <div class="cart-ordering__title">Информация о заказе</div>
              <ul class="cart-ordering__list">
                <li><span>Контактное лицо:</span><span>Иванов Иван Иванович</span></li>
                <li><span>Телефон:</span><span>8 (915) 130 12 45</span></li>
                <li><span>Способ доставки:</span><span>Курьерская доставка в пределах МКАД (300 руб.)</span></li>
                <li><span>Адрес доставки:</span><span>не указано</span></li>
                <li><span>Электронная почта:</span><span>не указано</span></li>
                <li><span>Комментарий:</span><span>домофон 6595</span></li>
                <li class="is-important"><span>Стоимость изделий:</span><span>27300 руб.</span></li>
                <li class="is-important"><span>Общая стоимость покупки:</span><span>27600 руб.</span></li>
              </ul>
            </div>@endif
    </div>
    <div class="cart__aside">
      <div class="cart-nav">
        <ul class="cart-nav__list">
          <li class="is-active">Список покупок</li>
          <li>Оформление заказа</li>
          <li>Информация о заказе</li>
        </ul>
        <div class="cart-nav__panel">
          <div class="cart-nav__total">
            <p>{{$cart_total}}</p>
          </div>
          <div class="cart-nav__button"><a class="button button--small button--red" href="">Начать оформление</a></div>
        </div>
      </div>
    </div>@endif
  </div>
</div>@endsection