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

// トップページ
Route::get('/', 'TopController@index')->name('index');

//コミュニティ
Route::get('/community', 'CommunityController@index')->name('community.index');

Route::get('/home', 'HomeController@index')->name('home');
