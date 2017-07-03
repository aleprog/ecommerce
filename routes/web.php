<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','MainController@home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('productos','ProductoController');

Route::resource('in_shopping_carts','InShoppingCartsController', [
  'only' => ['store','destroy']
]);
