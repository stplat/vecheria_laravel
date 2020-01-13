
@extends ('layout')
@section('content')
<div class="container">
  <div class="slider">
    <div class="swiper-container js-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="slider__content">
            <div class="slider__offer">
              <div class="slider__title">
                <p>Бусина в подарок</p>
              </div>
              <div class="slider__text">
                <p>При покупке любых трёх правосланых бусин -<br><strong>четвертая</strong> в подарок</p>
              </div>
              <div class="slider__button"><a class="button button--pink" href="/catalog/pravoslavnye_businy">В каталог</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="title">
      <div class="title__wrap">
        <p>Популярные изделия</p>
      </div>
    </div>
    <div class="swiper-container js-item-slider">
      <div class="swiper-wrapper">@foreach ($items as $key => $item)
        <div class="swiper-slide" style="padding: 0 5px 5px 0">
          <div class="item item--for-slider">
            <div class="item__sign">
              <p>{{$item->manufacturer}}</p>
            </div>
            <div class="item__article">{{$item->article}}</div>
            <div class="item__image"><a href="/catalog/{{$item->subcategory_plug}}/{{$item->plug}}">
                <picture>
                  <source srcset="/images/items/{{$item->plug}}t.webp" data-src="/images/items/{{$item->plug}}t.webp" type="image/webp"><img src="/images/items/{{$item->plug}}t.jpg" data-src="/images/items/{{$item->plug}}t.jpg" alt="{{$item->name}}" title="{{$item->name}}">
                </picture></a></div>
            <div class="item__name"><a href="/catalog/{{$item->subcategory_plug}}/{{$item->plug}}">{{$item->name}}</a></div>
            <div class="item__price">
              <p>{{$item->price}}</p>
            </div>
            <div class="item__button"><a class="button button--small" href="/catalog/{{$item->subcategory_plug}}/{{$item->plug}}">Подробнее</a>
            </div>
          </div>
        </div>@endforeach
      </div>
    </div>
    <div class="title">
      <div class="title__wrap">
        <p>Интернет-магазин православных ювелирных изделий «ВЕЧЕРИЯ»</p>
      </div>
    </div>
<div class="aboutus">
  <p>Здравствуйте, рады приветствовать Вас в нашем <strong>интернет-магазине православных изделий Вечерия!</strong></p>
  <p>У нас Вы сможете по низким ценам приобрести продукцию высочайшего качества от зарекомендовавших себя мастерских со всей страны, которые специализируются на производстве различных <i>православных изделий</i> и <i>ювелирных украшений</i>. В ассортименте представлены нательные кресты, образки, кольца, браслеты, цепи, шнурки и другие изделия, изготовленные из золота, серебра, серебра с позолотой из натуральных и искусственных драгоценные камней, кожи и прочего.</p>
  <p>Каждый найдет то что-то по душе или выберет в подарок для своих близких!<br></p>
  <p>Интернет-магазин осуществляет доставку по всей России.</p>
  <p>На товары предоставляется гарантия от производителя в соответствии с действующим законодательством Российской Федерации.</p>
  <p>Наш коллектив благодарит Вас за оказанное доверие.</p>
  <p>Вечерия станет Вашим другом и партнером на долгие годы!</p>
</div>
</div>@endsection