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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::middleware('api')->group(function () {
//    Route::resource('drinks', App\Http\Controllers\DrinkController::class);
//
//});

Route::post('register','App\Http\Controllers\UserController@register');
Route::post('login','App\Http\Controllers\Auth\LoginController@login');

Route::get('drinks', 'App\Http\Controllers\DrinkController@index')->name('index');
Route::post('drinks/store', 'App\Http\Controllers\DrinkController@store')->name('store');
Route::get('drink/{id}', 'App\Http\Controllers\DrinkController@show')->name('get-drink');
Route::post('drink/edit/{id}', 'App\Http\Controllers\DrinkController@update')->name('edit');
Route::post('drink/delete/{id}', 'App\Http\Controllers\DrinkController@destroy')->name('delete');
Route::post('drink/add-my-drink', 'App\Http\Controllers\DrinkController@addMyDrink')->name('add-my-drink');
Route::get('drinks/get-my-consumed-drinks', 'App\Http\Controllers\DrinkController@getMyConsumedDrinks')->name('get-my-consumed-drinks');
Route::get('drinks/get-my-drinks', 'App\Http\Controllers\DrinkController@getMyDrinks')->name('get-my-drinks');
