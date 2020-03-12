<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/posts/{post}/comments', 'CommentController@index')->name('index');
Route::patch('/posts/{post}/comments/{comment}', 'CommentController@update')->name('update');
Route::get('/posts/{post}/comments/{comment}', 'CommentController@retrieve')->name('retrieve');
Route::delete('/posts/{post}/comments/{comment}', 'CommentController@remove')->name('remove');
// add route to delete a comment
// add route to edit a comment

Route::post('/posts/{post}/comment', 'CommentController@store');

Route::middleware('auth:api')->group(function () {
    // Route::post('/posts/{post}/comment', 'CommentController@store');
});








// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
