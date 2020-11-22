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

// コミュニティ (認証あり)
Route::resource('/community', 'CommunityController')->except(['index','show'])->middleware('auth');
// コミュニティ一覧と詳細 (認証なし)
Route::resource('/community', 'CommunityController')->only(['index', 'show']);

//  プロフィール
Route::resource('/user', 'UserController')->parameters(['user' => 'user_name']);

Route::get('/home', 'HomeController@index')->name('home');
