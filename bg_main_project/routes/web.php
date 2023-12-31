<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
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
Route::group(['prefix' => 'admin', 'middleware' => 'AuthCheck'],function () {
    Route::get('/categories', [AdminController::class, 'getCategories'])->name('getCategories');
    Route::get('/category/add', [AdminController::class, 'addCategory'])->name('addCategory');
    Route::post('/category/store', [AdminController::class, 'storeCategory'])->name('storeCategory');
    Route::get('/category/edit/{id}', [AdminController::class, 'editCategory'])->name('editCategory');
    Route::post('/category/update/{id}', [AdminController::class, 'updateCategory'])->name('updateCategory');
    Route::get('/category/delete/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');

    Route::get('/posts', [AdminController::class, 'getPosts'])->name('getPosts');
    Route::get('/post/view/{id}', [AdminController::class, 'viewPost'])->name('viewPost');
    Route::get('/post/add', [AdminController::class, 'addPost'])->name('addPost');
    Route::post('/post/store', [AdminController::class, 'storePost'])->name('storePost');
    Route::get('/post/edit/{id}', [AdminController::class, 'editPost'])->name('editPost');
    Route::post('/post/update/{id}', [AdminController::class, 'updatePost'])->name('updatePost');
    Route::get('/post/delete/{id}', [AdminController::class, 'deletePost'])->name('deletePost');
});


Route::get('/', [PageController::class, 'guestHomePage'])->name('guestHomePage');
Route::get('/login', [AdminController::class, 'AdminDashboard'])->name('AdminDashboard');
Route::post('/login', [PageController::class, 'userLogin'])->name('userLogin');
Route::get('/logout', [PageController::class, 'userLogout'])->name('userLogout');
Route::get('/post/{id}', [PageController::class, 'getPost'])->name('getPost');
Route::get('/posts/{id}', [PageController::class, 'getCategoryPosts'])->name('getCategoryPosts');
