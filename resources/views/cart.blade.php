
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
  <div class="cart__content">@foreach ($items as $key => $item)
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
  </div>
  <div class="cart__aside">
    <div class="cart-nav">
      <ul class="cart-nav__list">
        <li class="is-active">Список покупок</li>
        <li>Контактные данные</li>
        <li>Доставка и оплата</li>
        <li>Сведения о заказе</li>
      </ul>
      <div class="cart-nav__sum"></div>
      <div class="cart-nav__panel">
        <div class="cart-nav__total">
          <p>25000</p>
        </div>
        <div class="cart-nav__button"><a class="button button--small button--red" href="">Оформить заказ</a></div>
        <div class="cart-nav__clear"><a href="">Очистить корзину</a></div>
      </div>
    </div>
  </div>@endif
</div>
</div>@endsection