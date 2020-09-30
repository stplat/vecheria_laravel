@extends('admin.layouts.app', ['title' => 'Создание товара'])
@section('content')
  <product-create :products="{{ $products }}" :categories="{{ $categories }}"></product-create>
@endsection
