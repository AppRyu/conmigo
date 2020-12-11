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

Route::get('/test', function() {
      return view('test');
});

Route::namespace('Front')->group(function() {

      // トップページ
      Route::get('/', 'TopController@index')->name('index');

      Route::group(['middleware' => 'auth'], function() {
            Route::resource('/community', 'CommunityController')->except(['index', 'show'])->parameters(['community' => 'id']);
            Route::post('/community/{id}/apply', 'CommunityController@apply')->name('community.apply');
            Route::get('/community/admin/{user_name}', 'CommunityAdminController@index')->name('community.admin');
      });
      Route::resource('/community', 'CommunityController')->only(['index', 'show'])->parameters(['community' => 'id']);

      //  プロフィール
      Route::resource('/user', 'UserController')->parameters(['user' => 'user_name']);
      
      Route::get('/home', 'HomeController@index')->name('home');

});

