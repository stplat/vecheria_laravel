<!DOCTYPE html>
<html>
  <head></head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0,width=device-width">
  <meta name="description" content="{{$description}}">
  <meta name="keywords" content="{{$keywords}}">
  <meta name="robots" content="">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <meta name="yandex-verification" content="2ff68d0f217a770e">
  <link href="/css/style.css" rel="stylesheet">
  <title>{{$title}}</title>
</html>
<body>
  <header class="header">
    <div class="header__cap">
      <div class="container container--flex">
        <div class="header__nav">
<div class="header-nav"><a class="header-nav__link" href="/">Главная</a><a class="header-nav__link" href="/">Доставка</a><a class="header-nav__link" href="/">Оплата</a><a class="header-nav__link" href="/">Контакты</a></div>
        </div>
        <div class="header__search">
          <div class="header-search"></div>
        </div>
      </div>
    </div>
    <div class="header__body">
      <div class="container container--flex">
        <div class="header__props">
<div class="header-props">
  <div class="header-props__phone"><a href="tel:+74952039696">+7 (495) 203-96-96</a></div>
  <ul class="header-props__ul">
    <li>Пн-пт 10:00 - 18:00 (МСК)</li>
    <li><a class="header-props__callback" href="">Заказать обратный звонок</a></li>
  </ul>
</div>
        </div>
        <div class="header__logo"><a class="logo" href="/"><img src="/images/logo.svg" alt="Интернет-магазин ювелирных православных изделий" title="Интернет-магазин ювелирных православных изделий"></a>
        </div>
        <div class="header__cart">
<div class="header-cart"><a class="header-cart__body" href=""><span> Корзина [<span>0</span>]</span></a><a class="header-cart__btn" href=""></a></div>
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
          <li><a href="">Главная</a></li>
          <li><a href="">Доставка</a></li>
          <li><a href="">Оплата</a></li>
          <li><a href="">Контакты</a></li>
          <li><a href="">Корзина</a></li>
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
        <p>Интернет-магазин ювелирных изделий vecheria.ru. All rights reserved ©2018-2019г.</p>
      </div>
    </div>
  </footer>
  <script src="/js/main.js" type="text/javascript"></script>
</body>