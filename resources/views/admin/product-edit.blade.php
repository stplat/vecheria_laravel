@extends('admin.layouts.app', ['title' => 'Редактирование товара'])
@section('content')
  <product-edit :initial-data="{{ $data }}"></product-edit>
@endsection
