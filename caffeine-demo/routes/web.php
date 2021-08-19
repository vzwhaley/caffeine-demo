<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// auth check
Route::get('/', function () {
    return redirect('/login');
});

// logout for router
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
});

Route::get('/user-register', 'App\Http\Controllers\UserController@show')->name('user-register');
Route::post('user-register', 'App\Http\Controllers\UserController@create');


Route::group(['middleware' => ['auth']], function () {

    Route::get('{any}', function () {
        return view('layouts/app');
    })->where('any', '.*');

    Route::get('drinks', 'App\Http\Controllers\DrinkController@index')->name('list');
});
