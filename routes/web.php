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

// Auth routes
Route::get( '/auth0/callback', '\Auth0\Login\Auth0Controller@callback' )->name( 'auth0-callback' );
Route::get( '/login', 'Auth\Auth0IndexController@login' )->name('login');
Route::get( '/logout', 'Auth\Auth0IndexController@logout' )->name('logout')->middleware('auth');

// Main routes
Route::redirect('/', '/home');
Route::get( '/home', 'PostsController@getPosts')->name('posts');
Route::get( '/posts/{post}', 'PostsController@getPost')->name('post');
Route::get( '/edit/{post}', 'PostsController@editPost')->name('editPost');
Route::patch( '/posts/{post}', 'PostsController@update')->name('update');
Route::delete('/posts/{post}', 'PostsController@remove')->name('remove');

Route::get( '/create', 'MainController@create')->name('create');
Route::post( '/', 'MainController@store')->name('store');

Route::get( '/account', 'MainController@account')->name('account');


// Moved to a service provider

// App::bind('App\Info', function () {
//     return new \App\Info(config('queue.sqs.secret'));
// });










