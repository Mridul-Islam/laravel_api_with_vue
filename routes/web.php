<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginControler;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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


Route::get('/', function () {
    return view('welcome');
});


Route::prefix('auth')->group(function(){

    Route::post('/login', LoginControler::Class)->middleware('guest');
    Route::post('/logout', LogoutController::Class)->middleware('auth');
    Route::post('/register', RegisterController::Class)->middleware('guest');

});
