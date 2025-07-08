<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::post('/oauth/token',     [AccessTokenController::class,'issueToken']);
Route::post('/register',        [UserController::class,'register']);
Route::middleware('auth:api')->group(function () {
    Route::get ('/validate',    [UserController::class,'validateToken']);
    Route::get ('/me',          [UserController::class,'me']);
    Route::post('/logout',      [UserController::class,'logout']);
    Route::post('/change-password',[UserController::class,'changePassword']);
});