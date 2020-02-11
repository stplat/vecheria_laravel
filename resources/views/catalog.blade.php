
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li>{{$subcategory}}</li>
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
    @foreach ($menu_items['subcategory'] as $plug => $subcategory_name)
    @if ($subcategory_name == $subcategory)<a class="filter-slide-box__link is-active" href="/catalog/{{$plug}}">{{$subcategory_name}}</a>@else<a class="filter-slide-box__link" href="/catalog/{{$plug}}">{{$subcategory_name}}</a>@endif
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
          <h1>{{$subcategory}}</h1>
        </div>
        <div class="catalog__top-panel">
          <div class="catalog__select">
            <div class="catalog-select"><span><i>На странице:</i>
                <select name="per_page">
                  <optgroup label="На странице:"></optgroup>
                  <option value="24" selected="selected">24 изделия</option>
                  <option value="36">36 изделия</option>
                  <option value="42">42 изделия</option>
                </select></span></div>
          </div>
          <div class="catalog__select">
            <div class="catalog-select"><span><i>Сортировка:</i>
                <select name="orderby">
                  <optgroup label="Сортировка:"></optgroup>
                  <option value="asc" selected="selected">по Увеличению цены</option>
                  <option value="desc">по Уменьшению цены</option>
                </select></span></div>
          </div>
          <div class="catalog__total">Показано: <span>{{$items->count()}} изд.</span></div>
        </div>
                <div class="item__container">@foreach ($items as $key => $item)
                  <div class="item item--3">
                    <div class="item__sign">
                      <p>{{$item->manufacturer}}</p>
                    </div>
                    <div class="item__article">{{$item->article}}</div>
                    <div class="item__image"><a href="/catalog/{{$item->subcategory_plug}}/{{$item->plug}}">
                        <picture>
                          <source srcset="/images/items/{{$item->plug}}-thumb.webp" data-src="/images/items/{{$item->plug}}-thumb.webp" type="image/webp"><img src="/images/items/{{$item->plug}}-thumb.jpg" data-src="/images/items/{{$item->plug}}-thumb.jpg" alt="{{$item->name}}" title="{{$item->name}}">
                        </picture></a></div>
                    <div class="item__name"><a href="/catalog/{{$item->subcategory_plug}}/{{$item->plug}}">{{$item->name}}</a></div>
                    <div class="item__price">
                      <p>{{$item->price}}</p>
                    </div>
                    <div class="item__button"><a class="button button--small" href="/catalog/{{$item->subcategory_plug}}/{{$item->plug}}">Подробнее</a>
                    </div>
                  </div>@endforeach
                </div>{{$items->render()}}
        @if ($category_comment)
        <div class="catalog__comment">
          <p>{!! $category_comment !!}</p>
        </div>@endif
      </div>
    </div>
  </div>
</div>@endsection