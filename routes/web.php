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

Route::get('/', function () {
    return view('welcome');
});


Route::any('/search','guestController@search');
Route::any('/filter','guestController@filterData');

// Route::get('/guesthome', function () {
//     return view('guesthome');
// });
Route::get('/guesthome','guestController@guestHome');

// Route::get('/products', function () {
//     return view('products');
// });


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/products', 'productsController@index');

// Route::get('/newproduct', function () {
//     return view('newproduct');
// })->middleware('auth');
Route::get('/newproduct','productsController@newproduct');

Route::post('/newproduct','productsController@add');
Route::get('/products','productsController@index'); //makr index
Route::get('/update/{id}','productsController@update');
Route::post('/edit/{id}','productsController@edit');
Route::get('/delete/{id}','productsController@delete');