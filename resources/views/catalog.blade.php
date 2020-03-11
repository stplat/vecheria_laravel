
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" href="/" itemprop="item"><span itemprop="name">Православный интернет-магазин «ВЕЧЕРИЯ»</span><meta itemprop="position" content="1" /></a></li>
      <li>{{$h1}}</li>
    </ul>
  <div class="catalog js-catalog">
    <div class="catalog__container">
      <div class="catalog__aside">
        <div class="catalog__filter">
<div class="filter">
<div class="filter-box">
  <div class="filter-box__head">Тип изделия</div>
  <div class="filter-box__body">
    <div class="filter-box__slide-box">
<div class="filter-slide-box">@foreach ($menu as $menu_items)
  <div class="filter-slide-box__head">{{$menu_items['category']}}</div>
  <div class="filter-slide-box__body">
    @foreach ($menu_items['subcategory'] as $slug => $subcategory_name)
    @if ($subcategory_name == $h1)<a class="filter-slide-box__link is-active" href="{{$slug}}">{{$subcategory_name}}</a>@else<a class="filter-slide-box__link" href="{{$slug}}">{{$subcategory_name}}</a>@endif
    @endforeach
  </div>@endforeach
</div>
    </div>
  </div>
</div>
</div>
        </div>
      </div>
      <div class="catalog__content">
        <div class="catalog__title">
          <h1>{{$h1}}</h1>
        </div>
        <div class="catalog__top-panel">
          <form id="sort" hidden></form>
          <div class="catalog__select">
            <div class="catalog-select"><span>На странице:</span>
              <select name="limit" form="sort">
                <optgroup label="На странице:"></optgroup>
                <option value="24" selected="selected">24 изделия</option>
                <option value="36">36 изделия</option>
                <option value="42">42 изделия</option>
              </select>
            </div>
          </div>
          <div class="catalog__select">
            <div class="catalog-select"><span>Сортировка:</span>
              <select name="orderby" form="sort">
                <optgroup label="Сортировка:"></optgroup>
                <option value="asc" selected="selected">по Увеличению цены</option>
                <option value="desc">по Уменьшению цены</option>
              </select>
            </div>
          </div>
          <div class="catalog__total">Показано: <span>{{$items->count()}} изд.</span></div>
        </div>
                <div class="item__container" itemscope itemtype="http://schema.org/ItemList">@foreach ($items as $key => $item)
                  <div class="item item--3" itemscope itemprop="itemListElement" itemtype="http://schema.org/Product">
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
                  </div>@endforeach
                </div>@if ($items->count() > 24)
        <div class="catalog__more">Показать еще</div>@endif
        @if ($description)
        <div class="catalog__comment">
          <p>{!! $description !!}</p>
        </div>@endif
      </div>
    </div>
  </div>
</div>@endsection