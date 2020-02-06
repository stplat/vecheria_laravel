
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li>Поиск</li>
    </ul>
  <div class="catalog">
    <div class="catalog__title">По поисковому запросу:
      <h1>Добрый вечер</h1>
    </div>
    <div class="catalog__container">
      <div class="catalog__content">
        <div class="catalog__top-panel">
          <div class="catalog__total">
            <p>Товары, соответствующие критериям поиска</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>@endsection