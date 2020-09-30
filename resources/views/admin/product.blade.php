@extends('admin.layouts.app', ['title' => 'Продукция'])
@section('content')
  <product :products="{{ $products }}" :categories="{{ $categories }}"></product>
@endsection
