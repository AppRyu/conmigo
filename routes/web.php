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

// コミュニティ
Route::resource('/community', 'CommunityController');

//  プロフィール
Route::resource('/user', 'UserController');

Route::get('/home', 'HomeController@index')->name('home');
