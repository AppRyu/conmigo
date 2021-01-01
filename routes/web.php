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

      // コミュニティ一覧＆詳細
      Route::resource('/community', 'CommunityController')->only(['index', 'show']);

      Route::group(['middleware' => 'auth'], function() {
            Route::resource('community', 'CommunityController')->except(['index', 'show']);
            Route::post('/community/{id}/apply', 'CommunityController@apply')->name('community.apply');
            Route::get('/community/admin/{user_name}', 'CommunityPlanedController@index')->name('community.planed');

            // 企画したコミュニティ
            Route::get('/community/plan/{community}', 'CommunityPlanedController@show')->name('community.plan.show');
            Route::post('/community/plan/{community}', 'CommunityPlanedController@determineUser')->name('community.plan.determineUser');
            
            // 応募したコミュニティ
            Route::get('/community/applied', 'CommunityAppliedController@index')->name('community.applied');

            // チャット
            Route::get('/chat/{community}', 'ChatController@show')->name('chat.show');
      });

      //  プロフィール
      // TODO : 一覧と詳細はログインしていなくても表示できるようにする
      Route::resource('/user', 'UserController')->parameters(['user' => 'user_name']);
      
      Route::get('/home', 'HomeController@index')->name('home');

});

