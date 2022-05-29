<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//crud
Route::get('/sedang_tayang', 'FilmsController@sedang_tayang');
Route::get('/coming_soon', 'FilmsController@coming_soon');
Route::post('/input_films', 'FilmsController@store');
Route::put('/update_films/{id}', 'FilmsController@update');
Route::delete('/delete_films/{id}', 'FilmsController@destroy');

//Favorit
Route::get('/favourite_user', 'FavouriteController@index');
Route::post('/favourite_user', 'FavouriteController@store');
Route::delete('/favourite_user/{id}', 'FavouriteController@destroy');

//rating
Route::post('/rating', 'RatingController@store');
Route::delete('/rating/{id}', 'RatingController@destroy');

//Autentikasi
// Route::post('/login', 'UsersController@login');
// Route::post('/register', 'UsersController@register');
// Route::post('/logout', 'UsersController@logout');
// Route::get('/me', 'UsersController@me');
