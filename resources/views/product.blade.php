
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li><a class="breadcrumb__link" href="/catalog/{{$category_plug}}">{{$subcategory}}</a></li>
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
  <div class="product-image__showcase"><img src="/images/items/{{$items->image_path}}"></div>
  <!--ul.product-image__preview
  li
    img(src!="/images/items/angel_hranitely_golgofa_gospody_vsederghitely_tolgskaya_ikona_boghiey_materi_2.jpg")
  li
    img(src!="/images/items/angel_hranitely_golgofa_gospody_vsederghitely_tolgskaya_ikona_boghiey_materi_2.jpg")
  li
    img(src!="/images/items/chasy_dve_stihii_a1100301_5.jpg")
  -->
</div>
        </div>
      </div>
      <div class="product__col">
        <div class="product__price">
          <p>{{$items->price}}</p>
        </div>
        <div class="product__row">
          <ul class="product__params">@if ($items->manufactured)
            <li><span>Производитель:</span><span>{{$items->manufactured}}</span></li>@endif
            @if ($items->weight)
            <li><span>Средний вес:</span><span>{{$items->weight}}</span></li>@endif
            @if ($items->material)
            <li><span>Материал:</span><span>{{$items->material}}</span></li>@endif
            @if ($items->technic)
            <li><span>Техника:</span><span>{{$items->technic}}</span></li>@endif
            <li><span>Наличие:</span><span class="green">на складе</span></li>
          </ul>
        </div>
        <div class="product__holy">
          <p>Изделие освящено</p>
        </div>
        <div class="product__row">
          <div class="product__button">@if (!$in_cart)<a class="button button--red" href="#">В корзину</a>@else
            <div class="product__alert">Товар в корзине</div>@endif
          </div>
          <div class="product__buy"><a href="">Быстрая покупка</a></div>
        </div>
      </div>
    </div>
    <div class="product__description">
<div class="product-desc">
  <ul class="product-desc__tab">
    <li>Описание</li>
  </ul>
  <div class="product_desc__body"><noindex> <p> {{$items->description}}</p></noindex></div>
</div>
    </div>
  </div>
</div>@endsection