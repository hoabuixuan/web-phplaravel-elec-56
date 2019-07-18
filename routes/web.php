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

// Route::get('/', function () {
//     // return view('welcome');
//     return view('client.pages.index');
// });
Route::get('/','HomeController@index');
Route::get('getproducttype','AjaxController@getProductType');

Route::group(['prefix' => 'admin'],function(){
    //wwww.example.com/admin/....
    Route::resource('category', 'CategoryController');
    Route::resource('product_type', 'ProductTypeController');
    Route::resource('product', 'ProductController');

    Route::post('updatePro/{id}','ProductController@update');
});

Route::get('callback/{social}','UserController@handleProviderCallback');
Route::get('login/{social}','UserController@redirectProvider')->name('login.social');
Route::get('logout','UserController@logout')->name('logout.social');
Route::post('updatepass','UserController@updatePwClient')->name('client.updatepw');
Route::post('login','UserController@login')->name('client.login');
Route::get('register','UserController@registerClient')->name('client.register');

Route::resource('cart','CartController');
Route::get('addCart/{id}','CartController@addCart')->name('cart.add');

