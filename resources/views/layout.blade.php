<!DOCTYPE html>
<html>
  <head></head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="{{$description}}">
  <meta name="keywords" content="{{$keywords}}">
  <meta name="robots" content="">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta name="yandex-verification" content="2ff68d0f217a770e">
  <!--meta(name="format-detection", content="telephone=no")-->
  <link href="/css/style.css" rel="stylesheet">
  <title>{{$title}}</title>
</html>
<body>
  <header class="header">
    <div class="header__cap">
      <div class="container container--flex">
        <div class="header__nav">
<div class="header-nav"><a class="header-nav__link header-nav__link--home" href="/">Главная</a><a class="header-nav__link header-nav__link--ship" href="/shipping">Доставка</a><a class="header-nav__link header-nav__link--pay" href="/payment">Оплата</a><a class="header-nav__link header-nav__link--cont" href="/contacts">Контакты</a><span class="header-nav__link header-nav__link--cat">Список категорий</span>
  <div class="header-nav__sub">
    @foreach ($menu as $menu_items)
    @foreach ($menu_items['subcategory'] as $plug => $subcategory)<a class="header-nav__link" href="/catalog/{{$plug}}">{{$subcategory}}</a>@endforeach
    @endforeach
  </div>
</div>
        </div>
        <div class="header__bar">
<div class="header-bar">
  <div class="header-bar__wrap">
    <div class="header-bar__inner"></div>
  </div>
</div>
        </div>
        <div class="header__filter">
<div class="header-filter">
  <div class="header-filter__ico"></div>
</div>
        </div>
      </div>
    </div>
    <div class="header__body">
      <div class="container container--flex">
        <div class="header__props">
<div class="header-props">
  <div class="header-props__phone"><a href="tel:+74952039696">+7 (495) 203-96-96</a></div>
  <ul class="header-props__ul">
    <li>Пн-пт 10:00 - 19:00 (МСК)</li>
    <li><span class="header-props__callback js-button-callback">Заказать обратный звонок</span></li>
  </ul>
</div>
        </div>
        <div class="header__logo"><a class="logo" href="/"><img src="/images/logo.svg" alt="Интернет-магазин ювелирных православных изделий" title="Интернет-магазин ювелирных православных изделий"></a>
        </div>
        <div class="header__cart">
<div class="header-cart"><a class="header-cart__body" href="/cart"><span>Корзина [<span>{{$cart_count}}</span>]</span></a><a class="header-cart__btn" href=""></a></div>
        </div>
      </div>
    </div>
  </header>
<div class="menu__container">
  <div class="container">
    <ul class="menu">@foreach ($menu as $menu_items)
      <li><span class="menu__plug">{{$menu_items['category']}}</span>
        <ul class="menu__submenu">@foreach ($menu_items['subcategory'] as $plug => $subcategory)
          <li><a class="menu__submenu-link" href="/catalog/{{$plug}}">{{$subcategory}}</a></li>@endforeach
        </ul>
      </li>@endforeach
    </ul>
  </div>
</div>@yield ('content')
  <footer class="footer">
    <div class="footer__top">
      <div class="container container--flex">
        <div class="footer__logo"><a class="logo" href="/"><img src="/images/logo-white.svg" alt="Интернет-магазин ювелирных православных изделий" title="Интернет-магазин ювелирных православных изделий"></a>
          <div class="footer__props">
            <p>ИП: Никитин Б.В.<br>ОГРНИП: 313774628200454</p>
          </div>
        </div>
        <ul class="footer__nav">
          <li><a href="/">Главная</a></li>
          <li><a href="/shipping">Доставка</a></li>
          <li><a href="/payment">Оплата</a></li>
          <li><a href="/contacts">Контакты</a></li>
          <li><a href="/cart">Корзина</a></li>
        </ul>
        <div class="footer__feedback">
          <div class="footer__phone"><a href="tel:+74952039696">+7 (495) 203-96-96</a></div>
          <div class="footer__text">
            <p>Приём заказов по телефону:<br> пн-пт c 10:00 до 19:00 (МСК)</p>
            <p>Заказы через интернет – круглосуточно</p>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__copyright">
      <div class="container">
        <p>Интернет-магазин православных ювелирных изделий vecheria.ru. All rights reserved ©2018-2019г.</p>
      </div>
    </div>
  </footer>
    <div class="popup js-popup-callback">
      <div class="popup__container">
        <div class="popup__header"><span class="popup__close"></span>
          <div class="popup__title">Заявка на обратный звонок</div>
          <p class="popup__desc">Оставьте свои контактные данные и мы свяжемся с Вами в ближайшее время!</p>
        </div>@if ($callback == 'sent')
        <div class="popup__body is-success">
          <div class="popup__success">Заявка успешно отправлена!</div>
        </div>@else
        <div class="popup__body">
          <form class="popup__form" id="callback">
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
              <button class="button">Отправить заявку</button>
            </div>
          </form>
          <div class="popup__offer">
            <p>Отправляя заявку, Вы соглашаетесь на обработку персональных данных</p>
          </div>
        </div>@endif
      </div>
    </div>
  <script src="/js/main.js" type="text/javascript"></script>
</body>