
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li><a class="breadcrumb__link" href="/catalog/{{$category_plug}}">{{$subcategory}}</a></li>
      <li>{{$items->name}}</li>
    </ul>
  <div class="product">
    <div class="product__wrapper">
      <div class="product__col product__col--left">
        <div class="product__name">
          <h1>{{$items->name}}</h1>
        </div>
        <div class="product__article">{{$items->article}}</div>
        <div class="product__image">
<div class="product-image">
  <div class="product-image__showcase"><img src="/images/items/angel_hranitely_golgofa_gospody_vsederghitely_tolgskaya_ikona_boghiey_materi_2.jpg"></div>
  <ul class="product-image__preview">
    <li><img src="/images/items/angel_hranitely_golgofa_gospody_vsederghitely_tolgskaya_ikona_boghiey_materi_2.jpg"></li>
    <li><img src="/images/items/angel_hranitely_golgofa_gospody_vsederghitely_tolgskaya_ikona_boghiey_materi_2.jpg"></li>
    <li><img src="/images/items/chasy_dve_stihii_a1100301_5.jpg"></li>
  </ul>
</div>
        </div>
      </div>
      <div class="product__col">
        <div class="product__price">
          <p>{{$items->price}}</p>
        </div>
        <div class="product__row">
          <div class="product__button"><a class="button button--red">В корзину</a>
          </div>
          <div class="product__buy"><a href="">Быстрая покупка</a></div>
        </div>
        <div class="product__holy">
          <p>Изделие освящено</p>
        </div>
        <div class="product__row">
          <ul class="product__params">@if ($items->manufactured)
            <li><span>Производитель:</span><span>{{$items->manufactured}}</span></li>@endif
            @if ($items->weight)
            <li><span>Вес:</span><span>{{$items->weight}}</span></li>@endif
            @if ($items->material)
            <li><span>Материал::</span><span>{{$items->material}}</span></li>@endif
            @if ($items->technic)
            <li><span>Техника:</span><span>{{$items->technic}}</span></li>@endif
          </ul>
        </div>
      </div>
    </div>
    <div class="product__description">
      <div class="product-desc">
        <ul class="product-desc__tab">
          <li>Описание</li>
        </ul>
        <div class="product_desc__body">
          <p>{{$items->description}}</p>
        </div>
      </div>
    </div>
  </div>
</div>@endsection