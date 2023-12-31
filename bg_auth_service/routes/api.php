<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/writers', [AuthController::class, 'getWriters'])->middleware('auth:sanctum');
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/check', [AuthController::class, 'authCheck'])->middleware('auth:sanctum');
Route::post('/auth/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
