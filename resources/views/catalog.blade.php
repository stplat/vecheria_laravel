
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Православный интернет-магазин «ВЕЧЕРИЯ»</a></li>
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
                <div class="item__container">@foreach ($items as $key => $item)
                  <div class="item item--3">
                    <div class="item__sign">
                      <p>{{$item->manufacturer}}</p>
                    </div>
                    <div class="item__article">{{$item->article}}</div>
                    <div class="item__image"><a href="/{{$item->slug}}">
                        <picture>
                          <source srcset="/images/items/{{$item->slug}}-thumb.webp" data-src="/images/items/{{$item->slug}}-thumb.webp" type="image/webp"><img src="/images/items/{{$item->slug}}-thumb.jpg" data-src="/images/items/{{$item->slug}}-thumb.jpg" alt="{{$item->name}}" title="{{$item->name}}">
                        </picture></a></div>
                    <div class="item__name"><a href="/{{$item->slug}}">{{$item->name}}</a></div>
                    <div class="item__price">
                      <p>{{$item->price}}</p>
                    </div>
                    <div class="item__button"><a class="button button--small" href="/{{$item->slug}}">Подробнее</a>
                    </div>
                  </div>@endforeach
                </div>@if ($description)
        <div class="catalog__more">Показать еще</div>
        <div class="catalog__comment">
          <p>{!! $description !!}</p>
        </div>@endif
      </div>
    </div>
  </div>
</div>@endsection