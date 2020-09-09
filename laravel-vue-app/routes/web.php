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

// 「Googleでログイン」ボタンを押した後のルーティング
Route::prefix('login')->name('login.')->group(function() {
  Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');

  // Googleアカウントでログイン可能にする
  Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});

// ユーザー名登録画面表示処理用
Route::prefix('register')->name('register.')->group(function() {
  Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
  Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});
Route::get('/', 'ArticleController@index')->name('articles.index');
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
