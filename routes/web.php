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




//　resourceの第一引数ので命名する複数形の文字列の
//　”単数系の文字列が自動でURLパラメーター”として設定される。

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'TasksController@index');

Route::resource('tasks', 'TasksController');





/*　ユーザー登録機能
*/
        //　ユーザー登録ページ取得
        Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
        //　ユーザー登録を処理
        Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');




/*　ログイン機能
    ->name()は、formやlink_to_route()で使う
*/

        //　ログインページ取得
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        
        //　ログイン情報を処理
        Route::post('login', 'Auth\LoginController@login')->name('login.post');
        
        //　
        Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
        
        
        
        
        
Route::group( ['middleware',['auth']],function(){
    
    
    //タスクのルーティングを設定します（登録のstoreと削除のdestroyのみ認証済みじゃないと見れない）
    Route::resource('tasks', 'TasksController', ['only' => ['store', 'destroy']]);
    
});