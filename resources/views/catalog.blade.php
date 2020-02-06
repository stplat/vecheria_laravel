
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li>{{$subcategory}}</li>
    </ul>
  <div class="catalog js-catalog">
    <div class="catalog__title">
      <h1>{{$subcategory}}</h1>
    </div>
    <div class="catalog__container">
      <div class="catalog__aside">
        <div class="catalog__filter">
<div class="filter">
  <div class="filter__head">Фильтр и сортировка</div>
  <div class="filter__part filter__part--sort">
    <div class="filter__title filter__title--sort">Сортировка</div>
    <div class="filter__switch">
<ul class="filter-switch">
  <li class="filter-switch__btn">
    <input type="radio" id="price_asc" name="orderby" value="asc" hidden checked>
    <label for="price_asc">По цене ↑</label>
  </li>
  <li class="filter-switch__btn">
    <input type="radio" id="price_desc" name="orderby" value="desc" hidden>
    <label for="price_desc">По цене ↓</label>
  </li>
</ul>
    </div>
  </div>
  <div class="filter__part">
    <div class="filter__title">Фильтр</div>
    <div class="filter__section">
<div class="filter-section">
  <div class="filter-section">
    <div class="filter-section__title">Категории</div>
    <div class="filter-section__list">
      @foreach ($menu as $menu_items)
      @foreach ($menu_items['subcategory'] as $plug => $subcategory_name)
      @if ($subcategory_name == $subcategory)<a class="filter-section__link is-active" href="/catalog/{{$plug}}">{{$subcategory_name}}</a>@else<a class="filter-section__link" href="/catalog/{{$plug}}">{{$subcategory_name}}</a>@endif
      @endforeach
      @endforeach
    </div>
  </div>
</div>
    </div>
  </div>
  <div class="filter__reset">
    <button>Сбросить фильтр и сортировку</button>
  </div>
</div>
        </div>
      </div>
      <div class="catalog__content">
        <div class="catalog__top-panel">
          <div class="catalog__total">
            <p>показано товаров: {{$items->count()}} из {{$items->total()}} ед.</p>
          </div>
          <div class="catalog__select">
            <select name="per_page">
              <option value="24" selected="selected">показывать по 24</option>
              <option value="36">показывать по 36</option>
              <option value="42">показывать по 42</option>
            </select>
          </div>
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