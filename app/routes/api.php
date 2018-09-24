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

Route::post('new', 'AuthController@register');

Route::post('login', 'AuthController@login');

Route::get('me', 'UserController@read');
Route::put('me', 'UserController@update');
Route::delete('me', 'UserController@delete');

//Route::apiResource('books', 'BookController');
//Route::post('books/{book}/ratings', 'RatingController@store');
