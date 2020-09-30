@include('admin.layouts._head')

<body>
@include('admin.layouts._aside')
<div class="app__content" id="content-slide">
  @include('admin.layouts._header')
  <main class="app__main" id="app" @auth v-cloak @endauth>
    @yield('content')
  </main>
</div>

@include('admin.layouts._footer')
