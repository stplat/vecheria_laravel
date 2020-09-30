<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{!! $title ?? '' !!}</title>
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/admin/32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/admin/16.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/admin/96.png') }}">
  <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
  @yield('content')
</div>
<script src="{{ asset('js/admin/app.js') }}" defer></script>
</body>
</html>
