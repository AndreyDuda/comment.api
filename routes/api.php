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

Route::group(
    [
        'namespace' => 'Api\Comment'
    ],
    function () {
        Route::get('comments', 'CommentController@index');
        Route::get('comments/{id}', 'CommentController@show');
        Route::post('comments', 'CommentController@store');
        Route::put('comments/{id}', 'CommentController@update');
        Route::delete('comments/{id}', 'CommentController@destroy');
    }
);
