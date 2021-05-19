<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('chat', '\App\Http\Controllers\ChatController@chat');
Route::post('send', '\App\Http\Controllers\ChatController@send');

Route::post('saveToSession', '\App\Http\Controllers\ChatController@saveToSession');
Route::post('getOldMessage', '\App\Http\Controllers\ChatController@getOldMessage');

Route::post('deleteSession', '\App\Http\Controllers\ChatController@deleteSession');



Route::get('/check', function(){
    return session('chat');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
