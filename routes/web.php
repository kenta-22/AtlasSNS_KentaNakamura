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

Route::get('/', function () {
    return view('layouts.login');// 'resources/views/layouts/logout.blade.php' を表示
});
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/users/profile/{id}','UsersController@profile');
Route::get('/users/profile/{id}/update', 'UsersController@profileUpdate');
Route::post('/users/profile/{id}/update/confirm', 'UsersController@profileUpdateConfirm');

Route::get('/users/search','UsersController@search');
Route::post('/users/search/result', 'UsersController@searchResult');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/post/{id}/delete', 'PostsController@deletePost');

Route::post('/post/create', 'PostsController@createPost');

Route::post('/post/update', 'PostsController@updatePost');

Route::get('/followlist','UsersController@followList');
Route::get('/followerlist','UsersController@followerList');

Route::post('/users/{id}/follow', 'FollowsController@follow');
Route::post('/users/{id}/unfollow', 'FollowsController@unfollow');
