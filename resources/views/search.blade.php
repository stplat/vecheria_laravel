
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a class="breadcrumb__link" href="/" itemprop="item"><span itemprop="name">Православный интернет-магазин «ВЕЧЕРИЯ»</span><meta itemprop="position" content="1" /></a></li>
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
            <p>найдено товаров: {{$items->count()}} ед.</p>
          </div>
        </div>
                <div class="item__container">@foreach ($items as $key => $item)
                  <div class="item item--4">
                    <div class="item__sign">
                      <p>{{$item->manufacturer}}</p>
                    </div>
                    <div class="item__article">{{$item->article}}</div>
                    <div class="item__image"><a href="/catalog/{{$item->category_slug}}/{{$item->slug}}">
                        <picture>
                          <source srcset="/images/items/{{$item->slug}}-thumb.webp" data-src="/images/items/{{$item->slug}}-thumb.webp" type="image/webp"><img src="/images/items/{{$item->slug}}-thumb.jpg" data-src="/images/items/{{$item->slug}}-thumb.jpg" alt="{{$item->name}}" title="{{$item->name}}">
                        </picture></a></div>
                    <div class="item__name"><a href="/catalog/{{$item->category_slug}}/{{$item->slug}}">{{$item->name}}</a></div>
                    <div class="item__price">
                      <p>{{$item->price}}</p>
                    </div>
                    <div class="item__button"><a class="button button--small" href="/catalog/{{$item->category_slug}}/{{$item->slug}}">Подробнее</a>
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