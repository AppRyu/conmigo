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

            // コミュニティ作成・更新・削除
            Route::resource('community', 'CommunityController')->except(['index', 'show']);

            // コミュニティ申請
            Route::post('/community/{id}/apply', 'CommunityController@apply')->name('community.apply');
            
            // 企画したコミュニティ：一覧・詳細・申請ユーザー認証
            Route::get('/community/plan', 'CommunityPlanedController@index')->name('community.plan.index');
            Route::get('/community/plan/{community}', 'CommunityPlanedController@show')->name('community.plan.show');
            Route::post('/community/plan/{community}', 'CommunityPlanedController@determineUser')->name('community.plan.determineUser');
            
            // コミュニティに対してのお気に入り機能
            Route::prefix('communities')->group(function() {
                  Route::put('{community}/like', 'CommunityController@like')->name('communities.like');
                  Route::delete('{community}/like', 'CommunityController@unlike')->name('communities.unlike');
                  // お気に入りコミュニティ一覧
                  Route::get('like', 'CommunityController@likes')->name('communities.likes');
            });

            // フォロー機能
            Route::prefix('users')->name('users.')->group(function() {
                  Route::put('/{user_name}/follow', 'UserController@follow')->name('follow');
                  Route::delete('/{user_name}/follow', 'UserController@unfollow')->name('unfollow');
            });
            
            // 応募したコミュニティ：一覧
            Route::get('/community/applied', 'CommunityApplyController@index')->name('community.applied');

            // チャットルーム：一覧
            Route::get('/chat', 'ChatController@index')->name('chat.index');

            // チャットルーム：個別（対象コミュニティが削除後もチャット履歴は残す）
            Route::get('/chat/{communityWithTrashed}', 'ChatController@show')->name('chat.show');
            Route::post('/chat/{community}', 'ChatController@sendMessage')->name('chat.sendMessage');

            // ダイレクトメッセージ
            Route::get('/message', 'MessageController@index')->name('message.index');
            Route::get('/message/show/{user}', 'MessageController@show')->name('message.show');

            // ユーザープロフィール：作成・更新・削除
            Route::resource('/user', 'UserController')->parameters(['user' => 'user_name'])->except(['index', 'show', 'destroy']);
            Route::resource('/user', 'UserController')->only('destroy');

            // 各種設定
            Route::get('/setting/{any?}', 'SettingController@index')->where('any', '.*')->name('setting');

      });

      // コミュニティ：一覧・詳細
      Route::resource('/community', 'CommunityController')->only(['index', 'show']);

      // フォロー＆フォロワー：一覧
      Route::get('follows/{any?}', 'UserController@follows')->where('any', '.*')->name('follows');

      //  ユーザープロフィール：一覧・詳細
      Route::resource('/user', 'UserController')->parameters(['user' => 'user_name'])->only(['index', 'show']);
      
      Route::get('/home', 'HomeController@index')->name('home');

});

Route::namespace('Ajax')->group(function() {
      
      Route::group(['middleware' => 'auth'], function() {

            Route::get('ajax/message', 'MessageController@index'); // メッセージ一覧を取得
            Route::post('ajax/message', 'MessageController@create'); // メッセージ登録

      });
      
});

