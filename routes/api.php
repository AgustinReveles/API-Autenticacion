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


Route::post('/register', [UserController::class, 'register']);
Route::middleware('auth:api')->get('/validate', [UserController::class, 'validateToken']);
Route::middleware('auth:api')->post('/logout', [UserController::class, 'logout']);
Route::middleware('auth:api')->get('/me', [UserController::class, 'me']);
Route::middleware('auth:api')->post('/change-password', [UserController::class, 'changePassword']);