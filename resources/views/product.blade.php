
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li><a class="breadcrumb__link" href="/catalog/{{$subcategory_plug}}">{{$subcategory}}</a></li>
      <li>{{$items->name}}</li>
    </ul>
  <div class="product" id="{{$items->id}}">
    <div class="product__wrapper">
      <div class="product__col product__col--left">
        <div class="product__name">
          <h1>{{$items->name}}</h1>
        </div>
        <div class="product__article">{{$items->article}}</div>
        <div class="product__image">
<div class="product-image">
  <div class="product-image__showcase">
    <picture>
      <source srcset="/images/items/{{$items->image_path[0]}}.webp" data-src="/images/items/{{$items->image_path[0]}}" type="image/webp"><img src="/images/items/{{$items->image_path[0]}}.jpg" data-src="/images/items/{{$items->image_path[0]}}.jpg" alt="{{$items->name}}" title="{{$items->name}}">
    </picture>
  </div>
  <ul class="product-image__preview">@foreach ($items->image_path as $image)
    <li>
      <picture>
        <source srcset="/images/items/{{$image}}.webp" data-src="/images/items/{{$image}}.webp" type="image/webp"><img src="/images/items/{{$image}}.jpg" data-src="/images/items/{{$image}}.jpg" alt="{{$items->name}}" title="{{$items->name}}">
      </picture>
    </li>@endforeach
  </ul>
</div>
        </div>
      </div>
      <div class="product__col">
        <div class="product__price">
          <p>{{$items->price}}</p>
        </div>
        <div class="product__row">
          <ul class="product__params">@if ($items->manufacturer)
            <li><span>Производитель:</span><span>{{$items->manufacturer}}</span></li>@endif
            @if ($items->weight)
            <li><span>Средний вес:</span><span>{{$items->weight}}</span></li>@endif
            @if ($items->material)
            <li><span>Материал:</span><span>{{$items->material}}</span></li>@endif
            @if ($items->technic)
            <li><span>Техника:</span><span>{{$items->technic}}</span></li>@endif
            @if ($items->dimension)
            <li><span>Размеры:</span><span>{{$items->dimension}}</span></li>@endif
            <li><span>Наличие:</span><span class="green">на складе</span></li>
          </ul>@if ($items->comment)
          <div class="product__comment">{!! $items->comment !!}</div>@endif
        </div>
        <div class="product__holy">
          <p>Изделие освящено</p>
        </div>
        <div class="product__row">@if (!$in_cart)
          <div class="product__button"><a class="button button--red" href="#" onclick="ym(&quot;47722900&quot;, &quot;reachGoal&quot;, &quot;CART&quot;); return true;">В корзину</a>
          </div>
          <div class="product__buy"><span class="js-button-buy">Быстрая покупка</span></div>@else
          <div class="product__alert">Товар в корзине</div>
          <div class="product__buy"><a href="/cart">Перейти в корзину</a></div>@endif
        </div>
      </div>
    </div>
    <div class="product__description">@if ($items->description)
<div class="product-desc">
  <ul class="product-desc__tab">
    <li>Описание</li>
  </ul>
  <div class="product-desc__body">
    <div class="product-desc__text">
      <p><!--noindex-->{!! $items->description !!}<!--/noindex--></p>
    </div>
  </div>
</div>@endif
    </div>
  </div>
    <div class="popup js-popup-buy">
      <div class="popup__container">
        <div class="popup__header"><span class="popup__close"></span>
          <div class="popup__title">Заявка на покупку</div>
          <p class="popup__desc">Оставьте свои контактные данные и мы свяжемся с Вами, что бы оформить заказ!</p>
        </div>@if ($buy == 'sent')
        <div class="popup__body is-success">
          <div class="popup__success">Заявка успешно отправлена!</div>
        </div>@else
        <div class="popup__body">
          <form class="popup__form" id="buy">
            <div class="popup__field">
              <label for="name">Имя:</label>
              <div class="popup__input">
                <input id="name" name="name" placeholder="Иванов Иван Иванович">
                <label for="name"></label>
              </div>
            </div>
            <div class="popup__field">
              <label for="phone">Телефон:</label>
              <div class="popup__input">
                <input type="tel" id="phone" name="phone" placeholder="Пример: 8 (495) 000-00-00">
                <label class="phone" for="phone"></label>
              </div>
            </div>
            <div class="popup__button">
              <button class="button">Заказать</button>
            </div>
          </form>
          <div class="popup__offer">
            <p>Отправляя заявку, Вы соглашаетесь на обработку персональных данных</p>
          </div>
        </div>@endif
      </div>
    </div>
</div>@endsection