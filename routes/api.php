<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\Auth\LoginControler;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\V1\CompleteTaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

require __DIR__ . '/api/v1.php';
require __DIR__ . '/api/v2.php';


Route::prefix('auth')->group(function(){

    Route::post('/login', LoginControler::Class);
    Route::post('/logout', LogoutController::Class)->middleware('auth:sanctum');
    Route::post('/register', RegisterController::Class);

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
