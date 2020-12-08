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
Route::get('/', 'TopController@index')
      ->name('index');

// コミュニティ (認証あり)
Route::resource('/community', 'CommunityController')
      ->except(['index','show'])
      ->parameters(['community' => 'id'])
      ->middleware('auth');
// コミュニティ一覧と詳細 (認証なし)
Route::resource('/community', 'CommunityController')
      ->only(['index', 'show'])
      ->parameters(['community' => 'id']);
// コミュニティに参加機能
Route::post('/community/{id}/apply', 'CommunityController@apply')
      ->name('community.apply')
      ->middleware('auth');

//  プロフィール
Route::resource('/user', 'UserController')
      ->parameters(['user' => 'user_name']);

Route::get('/home', 'HomeController@index')
      ->name('home');
