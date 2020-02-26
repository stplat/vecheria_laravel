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

Route::get('/', 'IndexController@index');
Route::get('/payment', 'PaymentController@index');
Route::get('/shipping', 'ShippingController@index');
Route::get('/contacts', 'ContactsController@index');
Route::get('/cart', 'CartController@index');
Route::get('/search', 'SearchController@index');

Route::get('/catalog/{category_slug}', 'CatalogController@index');
Route::get('/catalog/{category_slug}/{product_slug}', 'ProductController@index');

Route::get('/cart/addSession', function () {
  abort('404');
});

Route::get('/cart/removeSession', function () {
  abort('404');
});

Route::post('/cart/addSession', 'CartController@addSession');
Route::post('/cart/removeSession', 'CartController@removeSession');

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



Route::post('/callback', 'CallbackController@index');
Route::post('/buy', 'BuyController@index');
Route::post('/ordering', 'CartController@ordering');
Route::post('/checkPromo', 'CartController@checkPromo');

Route::get('/sitemap.xml', 'IndexController@sitemap');

Route::get('/clear-view', function() {
  Artisan::call('view:clear');
});
