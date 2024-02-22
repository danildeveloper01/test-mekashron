<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => '\App\Http\Controllers'], function() {
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login/store', 'AuthController@login_store')->name('login.store');
    Route::get('/registration', 'AuthController@registration')->name('registration');
    Route::post('/registration/store', 'AuthController@store')->name('store');
});
Route::group(['namespace' => '\App\Http\Controllers', 'middleware' => 'custom.auth'], function () {
    Route::get('/', 'GameController@index')->name('game');
    Route::post('/result', 'GameController@result')->name('game.result');
    Route::post('/logout', 'AuthController@logout')->name('logout');
});
