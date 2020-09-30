<div class="app__aside is-opened" id="aside-slide">
  <div class="aside">
    <div class="aside__logo"><img src="{{ asset('images/admin/logo-text.png') }}" alt=""></div>
    <div class="aside__menu">
      <ul class="menu">
        <li class="menu__item"><a href="" class="menu__link {{!request()->is('admin') ?: 'is-active'}}">Панель управления</a></li>
        <li class="menu__title">Разделы управления</li>
        <li class="menu__item"><a href="{{ route('admin.products.index') }}" class="menu__link menu__link--check {{!request()->is('admin/products') ?: 'is-active'}}">Продукция</a></li>
      </ul>
    </div>
  </div>
</div>
