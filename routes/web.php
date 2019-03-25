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


Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
//Routes For Category
Route::Resource('/categories','CategoryController');
Route::Resource('/products','ProductController');
Route::get('/allcategories', 'CategoryController@show');
Route::get('/allproducts', 'ProductController@show');
Route::get('/deleteproduct/{id}', 'ProductController@delete');
Route::get('/editproduct/{id}', 'ProductController@edit');
Route::post('/productupdate/{id}', 'ProductController@update');
//JSON
Route::get('/jsondata', 'ProductController@showjson');


