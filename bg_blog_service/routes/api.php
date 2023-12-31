<?php
use App\Http\Controllers\Api\PostController;
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

Route::get('/posts', [PostController::class, 'getAllPosts']);
Route::get('/posts/{id}', [PostController::class, 'getUserPosts']);
Route::get('/posts/category/{id}', [PostController::class, 'getCategoryPosts']);
Route::get('/post/{id}', [PostController::class, 'getSinglePost']);
Route::post('/post/create', [PostController::class, 'createPost']);
Route::post('/post/update/{id}', [PostController::class, 'updatePost']);
Route::delete('/post/{id}', [PostController::class, 'deleteSinglePost']);

