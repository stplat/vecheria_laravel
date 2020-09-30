<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| rutes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\IndexController@index');
Route::get('/payment', 'App\Http\Controllers\PaymentController@index');
Route::get('/shipping', 'App\Http\Controllers\ShippingController@index');
Route::get('/contacts', 'App\Http\Controllers\ContactsController@index');
Route::get('/cart', 'App\Http\Controllers\CartController@index');
Route::get('/search', 'App\Http\Controllers\SearchController@index');

Route::get('/catalog/{category_slug}', 'App\Http\Controllers\CatalogController@index');
Route::get('/catalog/{category_slug}/{product_slug}', 'App\Http\Controllers\ProductController@index');

Route::get('/cart/addSession', function () {
  abort('404');
});

Route::get('/cart/removeSession', function () {
  abort('404');
});

Route::post('/cart/addSession', 'App\Http\Controllers\CartController@addSession');
Route::post('/cart/removeSession', 'App\Http\Controllers\CartController@removeSession');

Route::get('/callback', function () {
  abort('404');
});

Route::get('/buy', function () {
  abort('404');
});

Route::get('/ordering', function () {
  abort('404');
});

Route::get('/checkPromo', function () {
  abort('404');
});


Route::post('/callback', 'App\Http\Controllers\CallbackController@index');
Route::post('/buy', 'App\Http\Controllers\BuyController@index');
Route::post('/ordering', 'App\Http\Controllers\CartController@ordering');
Route::post('/checkPromo', 'App\Http\Controllers\CartController@checkPromo');

Route::get('/sitemap.xml', 'App\Http\Controllers\IndexController@sitemap');

Route::get('/clear-view', function () {
  Artisan::call('view:clear');
});


/* Админ-панель */
Route::middleware('auth')->group(function () {

  Route::get('/admin', 'App\Http\Controllers\Admin\IndexController@index')->name('admin');

  Route::resource('/admin/products', 'App\Http\Controllers\Admin\ProductController', ['as' => 'admin'])
    ->only('index', 'show', 'create', 'store', 'edit', 'destroy');
  Route::post('/admin/products/update', 'App\Http\Controllers\Admin\ProductController@update')->name('admin.products.update');

  /* Таблицы vue-table-2 (экспорт) */
  Route::post('/table/export', 'App\Http\Controllers\TableController@export')->name('table-export');
});

Route::get('/admin/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('/admin/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
