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

Route::namespace('Front')->group(function() {

      // トップページ
      Route::get('/', 'TopController@index')->name('index');

      Route::group(['middleware' => 'auth'], function() {
            Route::resource('community', 'CommunityController')->except(['index', 'show']);
            Route::post('/community/{id}/apply', 'CommunityController@apply')->name('community.apply');
            
            // 企画したコミュニティ
            Route::get('/community/plan', 'CommunityPlanedController@index')->name('community.plan.index');
            Route::get('/community/plan/{community}', 'CommunityPlanedController@show')->name('community.plan.show');
            Route::post('/community/plan/{community}', 'CommunityPlanedController@determineUser')->name('community.plan.determineUser');
            
            // 応募したコミュニティ
            Route::get('/community/applied', 'CommunityApplyController@index')->name('community.applied');

            // チャットルーム
            Route::get('/chat', 'ChatController@index')->name('chat.index');
            Route::get('/chat/{community}', 'ChatController@show')->name('chat.show');
            Route::post('/chat/{community}', 'ChatController@sendMessage')->name('chat.sendMessage');

            // プロフィール
            Route::resource('/user', 'UserController')->parameters(['user' => 'user_name'])->except(['index', 'show']);
      });

      // コミュニティ一覧＆詳細
      Route::resource('/community', 'CommunityController')->only(['index', 'show']);


      //  プロフィール
      Route::resource('/user', 'UserController')->parameters(['user' => 'user_name'])->only(['index', 'show']);
      
      Route::get('/home', 'HomeController@index')->name('home');

});

