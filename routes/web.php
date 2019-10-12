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
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/topics', 'TopicController@index')->name('topics.index');
    Route::get('/topics/{topic}', 'TopicController@show')->name('topics.show');
    Route::post('/topics', 'TopicController@store')->name('topics.store');
    Route::post('/topics/{topic}/comments', 'TopicCommentController@store')->name('topics.comments.store');
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/follows', 'FollowController@index')->name('follows.index');
    Route::post('/users/{user}/follow', 'UserFollowController@store')->name('users.follow.store');
    Route::delete('/users/{user}/follow', 'UserFollowController@destroy')->name('users.follow.destroy');
});
