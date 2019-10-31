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

Route::get('/catalog/{category_plug}', 'CatalogController@index');
Route::get('/catalog/{category_plug}/{item_plug}', 'ProductController@index');

Route::get('/payment', 'PaymentController@index');
Route::get('/shipping', 'ShippingController@index');
Route::get('/contacts', 'ContactsController@index');

