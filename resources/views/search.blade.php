
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li>Поиск</li>
    </ul>
  <div class="catalog js-search">
    <div class="catalog__title"><span>Поисковый запрос -</span>
      <h1>{{$search_str}}</h1>
    </div>
    <div class="catalog__container">
      <div class="catalog__content">@if ($items)
        <div class="catalog__top-panel">
          <div class="catalog__total">
            <p>найдено товаров: {{$items->count()}} из {{$items->total()}} ед.</p>
          </div>
        </div>
                <div class="item__container">@foreach ($items as $key => $item)
                  <div class="item item--4">
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
                </div>@else
        <div class="catalog__top-panel">
          <div class="catalog__total">
            <p>по данному запросу ничего не найдено</p>
          </div>
        </div>@endif
      </div>
    </div>
  </div>
</div>@endsection