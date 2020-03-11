
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" href="/" itemprop="item"><span itemprop="name">Православный интернет-магазин «ВЕЧЕРИЯ»</span><meta itemprop="position" content="1" /></a></li>
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" href="/catalog/{{$product->category_slug}}" itemprop="item"><span itemprop="name">{{$product->category}}</span><meta itemprop="position" content="2" /></a></li>
      <li>{{$product->name}}</li>
    </ul>
  <div class="product" id="{{$product->product_id}}" itemscope itemtype="http://schema.org/Product">
    <div class="product__wrapper">
      <div class="product__col product__col--left">
        <div class="product__name">
          <h1 itemprop="name">{{$h1}}</h1>
        </div>
        <div class="product__article" itemprop="model">{{$product->article}}</div><meta itemprop="brand" content="{{$product->manufacturer}}">
<meta itemprop="description" content="{{strip_tags($product->description)}}">
        <div class="product__image">
<div class="product-image">
  <div class="product-image__showcase">
    <picture>
      <source srcset="/images/items/{{$product->image_path[0]}}.webp" data-src="/images/items/{{$product->image_path[0]}}" type="image/webp"><img src="/images/items/{{$product->image_path[0]}}.jpg" data-src="/images/items/{{$product->image_path[0]}}.jpg" alt="{{$product->name}}" title="{{$product->name}}" itemprop="image">
    </picture>
  </div>
  <ul class="product-image__preview">@foreach ($product->image_path as $image)
    <li>
      <picture>
        <source srcset="/images/items/{{$image}}.webp" data-src="/images/items/{{$image}}.webp" type="image/webp"><img src="/images/items/{{$image}}.jpg" data-src="/images/items/{{$image}}.jpg" alt="{{$product->name}}" title="{{$product->name}}">
      </picture>
    </li>@endforeach
  </ul>
</div>
        </div>
      </div>
      <div class="product__col" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <div class="product__price">
          <p itemprop="price">{{$product->price}}</p><meta itemprop="priceCurrency" content="RUB">
<meta itemprop="priceValidUntil" content="2020-12-31T21:30">
        </div>
        <div class="product__row">
          <ul class="product__params">@if ($product->manufacturer)
            <li><span>Производитель:</span><span>{{$product->manufacturer}}</span></li>@endif
            @if ($product->weight)
            <li><span>Средний вес:</span><span>{{$product->weight}}</span></li>@endif
            @if ($product->material)
            <li><span>Материал:</span><span>{{$product->material}}</span></li>@endif
            @if ($product->technic)
            <li><span>Техника:</span><span>{{$product->technic}}</span></li>@endif
            @if ($product->dimension)
            <li><span>Размеры:</span><span>{{$product->dimension}}</span></li>@endif
            <li><span>Наличие:</span><span class="green" itemprop="availability" content="http://schema.org/InStock">на складе</span></li>
          </ul>@if ($product->comment)
          <div class="product__comment">{!! $product->comment !!}</div>@endif
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
    <div class="product__description">
      <div class="product-desc">
        <ul class="product-desc__tab">@if ($product->description)
          <li class="is-active" data-for="1">Описание</li>@if ($product->video)
          <li data-for="2">Видео</li>@endif
          <li data-for="3">Доставка и оплата</li>
          <li data-for="4">Гарантии</li>@else
          @if ($product->video)
          <li class="is-active" data-for="2">Видео</li>
          <li data-for="3">Доставка и оплата</li>
          <li data-for="4">Гарантии</li>@else
          <li class="is-active" data-for="3">Доставка и оплата</li>
          <li data-for="4">Гарантии</li>@endif
          @endif
        </ul>
        <div class="product-desc__body">@if ($product->description)
          <div class="product-desc__screen is-active" data-id="1">
            <div class="product-desc__text">
              <p><!--noindex-->{!! $product->description !!}<!--/noindex--></p>
            </div>
          </div>@if ($product->video)
          <div class="product-desc__screen" data-id="2">{!! $product->video !!}</div>@endif
          <div class="product-desc__screen" data-id="3">
                  <div class="text text--product">
                    <div class="text__title">
                      <h2>По Москве</h2>
                    </div>
                    <p>
                      При общей сумме покупки <span class="red">менее 4&nbsp;000&nbsp;руб.</span>, стоимость доставки <strong>в пределах МКАД</strong> составляет – <strong>300&nbsp;руб.</strong><br/>При заказе на сумму <span class="red">4&nbsp;000&nbsp;руб. и более</span>, доставка <strong>в пределах МКАД</strong> бесплатная.</p>
                    <p>
                      Доставка осуществляется на следующий день <span class="red">с&nbsp;10.00 до&nbsp;20.00</span> со дня оформления заказа.<br/>Доставка <strong>«день в день»</strong> возможна, если заказ поступил <span class="red">до&nbsp;12.00</span>.</p>
                    <div class="text__title">
                      <h2>В Ближайшее Подмосковье</h2>
                    </div>
                    <p>
                      При общей сумме покупки <span class="red">менее 10&nbsp;000&nbsp;руб.</span>, стоимость доставки оплачивается по тарифам «Почты России» или по тарифам курьерской службы.</br>При заказе на сумму <span class="red">10&nbsp;000&nbsp;руб. и более</span>, доставка «Почтой России» или курьерской службой бесплатная.</p>
                    <p>Стоимость и срок доставки в Ваш регион уточняйте у нашего менеджера по телефону!</p>
                    <div class="text__title">
                      <h2>По России</h2>
                    </div>
                    <p>
                      Посылки отправляются <strong>«Почтой России»</strong> <a target="_blank" href="https://www.pochta.ru/support/post-rules/cash-on-delivery">наложенным платежом</a>:</br> - заказ прибудет в отделение «Почты России» по удобному для Вас адресу.
                      </br> - при получении посылки, Вам будет необходимо оплатить стоимость посылки согласно ее ценности.
                      </br> - ценность  посылки складывается из стоимости товара и доставки.
                    </p>
                    <p>При заказе на сумму <span class="red">10&nbsp;000&nbsp;руб. и более</span> доставка бесплатная.</p>
                    <p>Стоимость и срок доставки в Ваш регион уточняйте у нашего менеджера по телефону!</p>
                    <div class="text__title">
                      <h2>Оплата наличными курьеру</h2>
                    </div>
                    <p>
                      Оплата заказа производится по факту доставки, после проверки внешнего вида и комплектности. </br>При получении товара убедитесь в отсутствии дефектов и его соответствии с заказанным Вами на сайте.
                       </br>При наличии претензий к внешнему виду и комплектности товара Вы можете отказаться от товара.
                    </p>
                    <p class="red">Проверка товара происходит только в присутствии сотрудника службы доставки.</p>
                    <p><strong>Мы будем благодарны, если Вы заранее приготовите необходимую для оплаты заказа сумму!</strong></p>
                    <div class="text__title">
                      <h2>Перевод на карту ПАО "Сбербанк"</h2>
                    </div>
                    <p>Данный способ оплаты используется приемущественно для изготовления изделия на заказ.</p>
                    <p>
                      Учитывая тот факт, что изделия мастерских - это продукт ручной работы, понравившиеся Вам изделия могут отсутствовать в наличии и изготавливаются на заказ. Изготовление православного изделия на заказ осуществляется <span class="red">после 100% авансового платежа (предоплаты)</span>.</p>
                    <p><strong>Детали по использованию данного способа оплаты уточняйте у менеджера</strong>.</p>
                    <div class="text__signature">С уважением, vecheria.ru!</div>
                  </div>
          </div>
          <div class="product-desc__screen" data-id="4">
                  <div class="product-desc__text">
                    <p>Мы работаем только с проверенными мастерскими, которые имеют разрешение на изготовление ювелирных изделий из драгоценных металлов.</p>
                    <p><strong>Каждое изделие</strong>:</p>
                    <ul>
                      <li>Соответствует требованиям отраслевых стандартов <a href="/images/ost-117-3-002-95.pdf" target="_blank" rel="nofollow">(ГОСТ/ОСТ)</a>.</li>
                      <li>Имеет оттиск знака-именника предприятия-изготовителя, зарегистрированного в <a href="http://www.probpalata.ru/rgpp/" target="_blank" rel="nofollow">ГИПН РГПП</a>.</li>
                      <li>Заклеймено в соответствии с <a href="https://base.garant.ru/71393504/" target="_blank" rel="nofollow">Правилами клеймения изделий из драгоценных металлов</a>.</li>
                      <li>Иммет бирку с указанием металлов, вставок, веса и ОТК.</li>
                    </ul>
                  </div>
          </div>@else
          @if ($product->video)
          <div class="product-desc__screen is-active" data-id="2">{!! $product->video !!}</div>
          <div class="product-desc__screen" data-id="3">
                  <div class="text text--product">
                    <div class="text__title">
                      <h2>По Москве</h2>
                    </div>
                    <p>
                      При общей сумме покупки <span class="red">менее 4&nbsp;000&nbsp;руб.</span>, стоимость доставки <strong>в пределах МКАД</strong> составляет – <strong>300&nbsp;руб.</strong><br/>При заказе на сумму <span class="red">4&nbsp;000&nbsp;руб. и более</span>, доставка <strong>в пределах МКАД</strong> бесплатная.</p>
                    <p>
                      Доставка осуществляется на следующий день <span class="red">с&nbsp;10.00 до&nbsp;20.00</span> со дня оформления заказа.<br/>Доставка <strong>«день в день»</strong> возможна, если заказ поступил <span class="red">до&nbsp;12.00</span>.</p>
                    <div class="text__title">
                      <h2>В Ближайшее Подмосковье</h2>
                    </div>
                    <p>
                      При общей сумме покупки <span class="red">менее 10&nbsp;000&nbsp;руб.</span>, стоимость доставки оплачивается по тарифам «Почты России» или по тарифам курьерской службы.</br>При заказе на сумму <span class="red">10&nbsp;000&nbsp;руб. и более</span>, доставка «Почтой России» или курьерской службой бесплатная.</p>
                    <p>Стоимость и срок доставки в Ваш регион уточняйте у нашего менеджера по телефону!</p>
                    <div class="text__title">
                      <h2>По России</h2>
                    </div>
                    <p>
                      Посылки отправляются <strong>«Почтой России»</strong> <a target="_blank" href="https://www.pochta.ru/support/post-rules/cash-on-delivery">наложенным платежом</a>:</br> - заказ прибудет в отделение «Почты России» по удобному для Вас адресу.
                      </br> - при получении посылки, Вам будет необходимо оплатить стоимость посылки согласно ее ценности.
                      </br> - ценность  посылки складывается из стоимости товара и доставки.
                    </p>
                    <p>При заказе на сумму <span class="red">10&nbsp;000&nbsp;руб. и более</span> доставка бесплатная.</p>
                    <p>Стоимость и срок доставки в Ваш регион уточняйте у нашего менеджера по телефону!</p>
                    <div class="text__title">
                      <h2>Оплата наличными курьеру</h2>
                    </div>
                    <p>
                      Оплата заказа производится по факту доставки, после проверки внешнего вида и комплектности. </br>При получении товара убедитесь в отсутствии дефектов и его соответствии с заказанным Вами на сайте.
                       </br>При наличии претензий к внешнему виду и комплектности товара Вы можете отказаться от товара.
                    </p>
                    <p class="red">Проверка товара происходит только в присутствии сотрудника службы доставки.</p>
                    <p><strong>Мы будем благодарны, если Вы заранее приготовите необходимую для оплаты заказа сумму!</strong></p>
                    <div class="text__title">
                      <h2>Перевод на карту ПАО "Сбербанк"</h2>
                    </div>
                    <p>Данный способ оплаты используется приемущественно для изготовления изделия на заказ.</p>
                    <p>
                      Учитывая тот факт, что изделия мастерских - это продукт ручной работы, понравившиеся Вам изделия могут отсутствовать в наличии и изготавливаются на заказ. Изготовление православного изделия на заказ осуществляется <span class="red">после 100% авансового платежа (предоплаты)</span>.</p>
                    <p><strong>Детали по использованию данного способа оплаты уточняйте у менеджера</strong>.</p>
                    <div class="text__signature">С уважением, vecheria.ru!</div>
                  </div>
          </div>
          <div class="product-desc__screen" data-id="4">
                  <div class="product-desc__text">
                    <p>Мы работаем только с проверенными мастерскими, которые имеют разрешение на изготовление ювелирных изделий из драгоценных металлов.</p>
                    <p><strong>Каждое изделие</strong>:</p>
                    <ul>
                      <li>Соответствует требованиям отраслевых стандартов <a href="/images/ost-117-3-002-95.pdf" target="_blank" rel="nofollow">(ГОСТ/ОСТ)</a>.</li>
                      <li>Имеет оттиск знака-именника предприятия-изготовителя, зарегистрированного в <a href="http://www.probpalata.ru/rgpp/" target="_blank" rel="nofollow">ГИПН РГПП</a>.</li>
                      <li>Заклеймено в соответствии с <a href="https://base.garant.ru/71393504/" target="_blank" rel="nofollow">Правилами клеймения изделий из драгоценных металлов</a>.</li>
                      <li>Иммет бирку с указанием металлов, вставок, веса и ОТК.</li>
                    </ul>
                  </div>
          </div>@else
          <div class="product-desc__screen is-active" data-id="3">
                  <div class="text text--product">
                    <div class="text__title">
                      <h2>По Москве</h2>
                    </div>
                    <p>
                      При общей сумме покупки <span class="red">менее 4&nbsp;000&nbsp;руб.</span>, стоимость доставки <strong>в пределах МКАД</strong> составляет – <strong>300&nbsp;руб.</strong><br/>При заказе на сумму <span class="red">4&nbsp;000&nbsp;руб. и более</span>, доставка <strong>в пределах МКАД</strong> бесплатная.</p>
                    <p>
                      Доставка осуществляется на следующий день <span class="red">с&nbsp;10.00 до&nbsp;20.00</span> со дня оформления заказа.<br/>Доставка <strong>«день в день»</strong> возможна, если заказ поступил <span class="red">до&nbsp;12.00</span>.</p>
                    <div class="text__title">
                      <h2>В Ближайшее Подмосковье</h2>
                    </div>
                    <p>
                      При общей сумме покупки <span class="red">менее 10&nbsp;000&nbsp;руб.</span>, стоимость доставки оплачивается по тарифам «Почты России» или по тарифам курьерской службы.</br>При заказе на сумму <span class="red">10&nbsp;000&nbsp;руб. и более</span>, доставка «Почтой России» или курьерской службой бесплатная.</p>
                    <p>Стоимость и срок доставки в Ваш регион уточняйте у нашего менеджера по телефону!</p>
                    <div class="text__title">
                      <h2>По России</h2>
                    </div>
                    <p>
                      Посылки отправляются <strong>«Почтой России»</strong> <a target="_blank" href="https://www.pochta.ru/support/post-rules/cash-on-delivery">наложенным платежом</a>:</br> - заказ прибудет в отделение «Почты России» по удобному для Вас адресу.
                      </br> - при получении посылки, Вам будет необходимо оплатить стоимость посылки согласно ее ценности.
                      </br> - ценность  посылки складывается из стоимости товара и доставки.
                    </p>
                    <p>При заказе на сумму <span class="red">10&nbsp;000&nbsp;руб. и более</span> доставка бесплатная.</p>
                    <p>Стоимость и срок доставки в Ваш регион уточняйте у нашего менеджера по телефону!</p>
                    <div class="text__title">
                      <h2>Оплата наличными курьеру</h2>
                    </div>
                    <p>
                      Оплата заказа производится по факту доставки, после проверки внешнего вида и комплектности. </br>При получении товара убедитесь в отсутствии дефектов и его соответствии с заказанным Вами на сайте.
                       </br>При наличии претензий к внешнему виду и комплектности товара Вы можете отказаться от товара.
                    </p>
                    <p class="red">Проверка товара происходит только в присутствии сотрудника службы доставки.</p>
                    <p><strong>Мы будем благодарны, если Вы заранее приготовите необходимую для оплаты заказа сумму!</strong></p>
                    <div class="text__title">
                      <h2>Перевод на карту ПАО "Сбербанк"</h2>
                    </div>
                    <p>Данный способ оплаты используется приемущественно для изготовления изделия на заказ.</p>
                    <p>
                      Учитывая тот факт, что изделия мастерских - это продукт ручной работы, понравившиеся Вам изделия могут отсутствовать в наличии и изготавливаются на заказ. Изготовление православного изделия на заказ осуществляется <span class="red">после 100% авансового платежа (предоплаты)</span>.</p>
                    <p><strong>Детали по использованию данного способа оплаты уточняйте у менеджера</strong>.</p>
                    <div class="text__signature">С уважением, vecheria.ru!</div>
                  </div>
          </div>
          <div class="product-desc__screen" data-id="4">
                  <div class="product-desc__text">
                    <p>Мы работаем только с проверенными мастерскими, которые имеют разрешение на изготовление ювелирных изделий из драгоценных металлов.</p>
                    <p><strong>Каждое изделие</strong>:</p>
                    <ul>
                      <li>Соответствует требованиям отраслевых стандартов <a href="/images/ost-117-3-002-95.pdf" target="_blank" rel="nofollow">(ГОСТ/ОСТ)</a>.</li>
                      <li>Имеет оттиск знака-именника предприятия-изготовителя, зарегистрированного в <a href="http://www.probpalata.ru/rgpp/" target="_blank" rel="nofollow">ГИПН РГПП</a>.</li>
                      <li>Заклеймено в соответствии с <a href="https://base.garant.ru/71393504/" target="_blank" rel="nofollow">Правилами клеймения изделий из драгоценных металлов</a>.</li>
                      <li>Иммет бирку с указанием металлов, вставок, веса и ОТК.</li>
                    </ul>
                  </div>
          </div>@endif
          @endif
        </div>
      </div>
    </div>@if ($product->similar_product_id)
        <div class="title">
          <div class="title__wrap">
            <h3>Похожие товары</h3>
          </div>
        </div>
        <div class="swiper-container js-item-slider">
          <div class="swiper-wrapper" itemscope itemtype="http://schema.org/ItemList">@foreach ($similar_products as $key => $item)
            <div class="swiper-slide" style="padding: 0 5px 5px 0">
              <div class="item item--for-slider" itemscope itemprop="itemListElement" itemtype="http://schema.org/Product">
                <div class="item__sign">
                  <p itemprop="brand">{{$item->manufacturer}}</p>
                </div>
                <div class="item__article" itemprop="model">{{$item->article}}</div>
                <div class="item__image"><a href="/catalog/{{$item->category_slug}}/{{$item->slug}}" itemprop="url">
                    <picture>
                      <source srcset="/images/items/{{$item->slug}}-thumb.webp" data-src="/images/items/{{$item->slug}}-thumb.webp" type="image/webp"><img src="/images/items/{{$item->slug}}-thumb.jpg" data-src="/images/items/{{$item->slug}}-thumb.jpg" alt="{{$item->name}}" title="{{$item->name}}" itemprop="image"><meta itemprop="description" content="{{$item->name}}">
                    </picture></a></div>
                <div class="item__name"><a href="/catalog/{{$item->category_slug}}/{{$item->slug}}"><span itemprop="name">{{$item->name}}</span></a></div>
                <div class="item__price" itemscope itemprop="offers" itemtype="http://schema.org/Offer">
                  <p itemprop="price">{{$item->price}}</p><meta itemprop="priceCurrency" content="RUB">
<meta itemprop="availability" content="http://schema.org/InStock">
<link itemprop="url" href="{{ url('') }}/catalog/{{$item->category_slug}}/{{$item->slug}}" />
                </div>
                <div class="item__button"><a class="button button--small" href="/catalog/{{$item->category_slug}}/{{$item->slug}}">Подробнее</a>
                </div>
              </div>
            </div>@endforeach
          </div>
        </div>@endif
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