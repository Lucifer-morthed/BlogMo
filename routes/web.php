<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\AuthController;

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

Route::get('/', [BlogController::class, 'home'])->name('home');
Route::get('/posts/{slug}', [BlogController::class, 'post'])->name('post.show');
Route::get('/categories/{slug}', [BlogController::class, 'category'])->name('category.show');
Route::get('/search', [BlogController::class, 'search'])->name('search');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BlogController::class, 'dashboard'])->name('dashboard');
    Route::get('/create-post', [BlogController::class, 'createPost'])->name('post.create');
    Route::post('/posts', [BlogController::class, 'storePost'])->name('post.store');
    Route::get('/posts/{id}/edit', [BlogController::class, 'editPost'])->name('post.edit');
    Route::put('/posts/{id}', [BlogController::class, 'updatePost'])->name('post.update');
    Route::delete('/posts/{id}', [BlogController::class, 'deletePost'])->name('post.delete');

    // Comment routes - handled in API routes
    // Admin routes (require admin role)
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Web\AdminController::class, 'index'])->name('index');
        Route::post('/posts/{id}/approve', [\App\Http\Controllers\Web\AdminController::class, 'approvePost'])->name('posts.approve');
        Route::delete('/posts/{id}/reject', [\App\Http\Controllers\Web\AdminController::class, 'rejectPost'])->name('posts.reject');
        Route::post('/categories', [\App\Http\Controllers\Web\AdminController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{id}', [\App\Http\Controllers\Web\AdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{id}', [\App\Http\Controllers\Web\AdminController::class, 'deleteCategory'])->name('categories.delete');
        Route::put('/users/{userId}/role', [\App\Http\Controllers\Web\AdminController::class, 'updateUserRole'])->name('users.update-role');
    });
});
