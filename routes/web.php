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


Route::get('/', 'TasksController@index');

//　resourceの第一引数ので命名する複数形の文字列の
//　”単数系の文字列が自動でURLパラメーター”として設定される。

Route::resource('tasks', 'TasksController');

Route::get('tasks/{id}/copy', 'TasksController@copy');

