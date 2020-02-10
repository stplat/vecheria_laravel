<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="{{$description}}">
    <meta name="keywords" content="{{$keywords}}">
    <meta name="robots" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="yandex-verification" content="da85a8cc7d3802f8">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,700&amp;display=swap" rel="stylesheet">
    <title>{{$title}}</title>
  </head>
  <body><!-- Yandex.Metrika counter -->
    <!--script.
    (function (m, e, t, r, i, k, a) {
      m[i] = m[i] || function () {
        (m[i].a = m[i].a || []).push(arguments)
      };
      m[i].l = 1 * new Date();
      k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
    ym(47722900, "init", {
      clickmap: true,
      trackLinks: true,
      accurateTrackBounce: true,
      webvisor: true,
      ecommerce: "dataLayer"
    });
    --><!--/Yandex.Metrika counter -->
    <style type="text/css">
      .no-webp .slider__content {
        background: url(/images/banner_1.png) no-repeat right, url(/images/banner_1-bg.png);
        background-size: contain;
      }
      
      .webp .slider__content {
        background: url(/images/banner_1.webp) no-repeat right, url(/images/banner_1-bg.webp);
        background-size: contain;
      }
      
      @font-face {
        font-family: 'Fontello';
        src: url(data:application/font-woff2;charset=utf-8;base64,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) format('woff2'),
        url(data:application/font-woff;charset=utf-8;base64,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) format('woff');
        font-weight: normal;
        font-style: normal;
      }
      
    </style>
    <header class="header" itemscope itemtype="http://schema.org/Organization">
      <div class="header__cap">
        <div class="container container--flex">
          <div class="header__nav">
<div class="header-nav"><a class="header-nav__link header-nav__link--home" href="/">Главная</a><a class="header-nav__link header-nav__link--ship" href="/shipping">Доставка</a><a class="header-nav__link header-nav__link--pay" href="/payment">Оплата</a><a class="header-nav__link header-nav__link--cont" href="/contacts">Контакты</a><span class="header-nav__link header-nav__link--cat">Список категорий</span>
  <div class="header-nav__sub">@foreach ($menu as $menu_items)
    <div class="header-nav__group">{{$menu_items['category']}}</div>@foreach ($menu_items['subcategory'] as $plug => $subcategory)<a class="header-nav__link" href="/catalog/{{$plug}}">{{$subcategory}}</a>@endforeach
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
  <div class="header-props__phone"><a href="tel:+74952039696" itemprop="telephone">+7 (495) 203-96-96</a></div>
  <ul class="header-props__ul" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
    <li>Пн-пт 10:00 - 19:00 (<span itemprop="addressLocality">Москва</span>)</li>
    <li><span class="header-props__callback js-button-callback">Заказать обратный звонок</span></li>
  </ul>
</div>
          </div>
          <div class="header__logo"><span itemprop="name" hidden>«ВЕЧЕРИЯ»</span><a class="logo" href="/"><img src="/images/logo.svg" alt="Интернет-магазин ювелирных православных изделий" title="Интернет-магазин ювелирных православных изделий"></a>
            <div class="header__search">
<form class="header-search" method="GET" action="/search">
  <input class="header-search__input" type="search" placeholder="Поиск по названию или артикулу" name="search">
  <button class="header-search__button"></button>
</form>
            </div>
          </div>
          <div class="header__cart">
<div class="header-cart"><a class="header-cart__body" href="/cart"><span>Корзина [<span>{{$cart_count}}</span>]</span></a><a class="header-cart__btn" href=""></a></div>
          </div>
        </div>
      </div>
    </header>
<div class="menu__container">
  <nav class="container">
    <ul class="menu">@foreach ($menu as $menu_items)
      <li><span class="menu__plug">{{$menu_items['category']}}</span>
        <ul class="menu__submenu">@foreach ($menu_items['subcategory'] as $plug => $subcategory)
          <li><a class="menu__submenu-link" href="/catalog/{{$plug}}">{{$subcategory}}</a></li>@endforeach
        </ul>
      </li>@endforeach
    </ul>
  </nav>
</div>@yield ('content')
    <footer class="footer"><a class="up" href=""></a>
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
          <p>Интернет-магазин православных ювелирных изделий vecheria.ru. All rights reserved ©2018-2020г.</p>
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
                  <label for="callback-name">Имя:</label>
                  <div class="popup__input">
                    <input id="callback-name" name="name" placeholder="Иванов Иван Иванович">
                    <label for="callback-name"></label>
                  </div>
                </div>
                <div class="popup__field">
                  <label for="callback-phone">Телефон:</label>
                  <div class="popup__input">
                    <input type="tel" id="callback-phone" name="phone" placeholder="Пример: 8 (495) 000-00-00">
                    <label class="phone" for="callback-phone"></label>
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
    <script src="/js/main.js"></script>
    <!--script.
    (function () {
      window['yandexChatWidgetCallback'] = function () {
        try {
          window.yandexChatWidget = new Ya.ChatWidget({
            guid: '11269400-b876-4363-895f-115590787b40',
            buttonText: '',
            title: 'Чат',
            theme: 'dark',
            collapsedDesktop: 'never',
            collapsedTouch: 'never'
          });
        } catch (e) {
        }
      };
      var n = document.getElementsByTagName('script')[0],
        s = document.createElement('script');
      s.async = true;
      s.charset = 'UTF-8';
      s.src = 'https://chat.s3.yandex.net/widget.js';
      n.parentNode.insertBefore(s, n);
    })();
    -->
  </body>
</html>