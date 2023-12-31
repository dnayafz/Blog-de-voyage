<?php

use App\Http\Controllers\Api\MediaController;
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

Route::get('/media/{id}', [MediaController::class, 'getSingleMedia']);
Route::post('/media/create', [MediaController::class, 'createMedia']);
Route::post('/media/update/{id}', [MediaController::class, 'updateMedia']);
Route::delete('/media/{id}', [MediaController::class, 'deleteSingleMedia']);
