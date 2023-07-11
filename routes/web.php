<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/','ReaderController@index')->name('welcome');
Route::get('/admin', 'HomeController@index')->name('admin');

//categories
Route::prefix('/category')->name('category.')->group(function(){
    Route::get('/','CategoryController@index')->name('index');
    Route::get('/edit/{id}','CategoryController@edit')->name('edit');
    Route::put('/update/{id}','CategoryController@update')->name('update');
    Route::delete('/delete/{id}','CategoryController@destroy')->name('destroy');
    Route::post('/store','CategoryController@store')->name('store');
    Route::get('/create','CategoryController@create')->name('create');
});
//posts
Route::prefix('/post')->name('post.')->group(function(){
    Route::get('/','PostController@index')->name('index');
    Route::get('/create','PostController@create')->name('create');
    Route::get('edit/{id}','PostController@edit')->name('edit');
    Route::put('update/{id}','PostController@update')->name('update');
    Route::post('/store','PostController@store')->name('store');
    Route::get('view/{id}','PostController@view')->name('view');
    Route::delete('destroy/{id}','PostController@destroy')->name('destroy');
});
//Affiliate
Route::prefix('/affiliate')->name('affiliate.')->group(function(){
    Route::get('/','AffiliateController@index')->name('index');
    Route::get('/create','AffiliateController@create')->name('create');
    Route::get('/edit/{id}','AffiliateController@edit')->name('edit');
    Route::put('/update/{id}','AffiliateController@update')->name('update');
    Route::post('/store','AffiliateController@store')->name('store');
    Route::delete('/destroy/{id}','AffiliateController@destroy')->name('destroy');
});
//Readers
Route::prefix('/')->name('reader.')->group(function(){
    Route::get('/','ReaderController@index')->name('welcome');
    Route::get('/blog','ReaderController@blog')->name('blog');
    Route::get('/affiliate/{id}','ReaderController@affiliate')->name('affiliate');
    Route::match(['get', 'post'], '/search', 'ReaderController@search')->name('search');
    Route::get('/view/{id}','ReaderController@view')->name('view');
    Route::get('/category/{id}','ReaderController@category')->name('category');
});
