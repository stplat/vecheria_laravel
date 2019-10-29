
@extends ('layout')
@section('content')
<div class="container">
    <ul class="breadcrumb">
      <li><a class="breadcrumb__link" href="/">Главная</a></li>
      <li><a class="breadcrumb__link" href="/catalog/{{$category_plug}}">{{$subcategory}}</a></li>
      <li>{{$items->name}}</li>
    </ul>
</div>@endsection