<?php

use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
    // Authentication routes (public)
    Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);

    // Public routes
    Route::apiResource('posts', PostController::class)->only(['index', 'show']);
    Route::get('posts/search/{query}', [PostController::class, 'search']);
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

    // Comments (public read, authenticated create)
    Route::get('posts/{post}/comments', [CommentController::class, 'index']);
    Route::get('comments/{comment}/replies', [CommentController::class, 'replies']);

    // Authentication routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        // Authenticated post management
        Route::apiResource('posts', PostController::class)->except(['index', 'show']);

        // Authenticated category management (admin only)
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);

        // Comment management
        Route::apiResource('comments', CommentController::class)->except(['index']);

        // Admin routes
        Route::prefix('admin')->middleware('admin')->group(function () {
            Route::get('stats', [AdminController::class, 'stats']);
            Route::post('posts/{post}/publish', [AdminController::class, 'publishPost']);
            Route::post('posts/{post}/unpublish', [AdminController::class, 'unpublishPost']);
            Route::post('comments/{comment}/approve', [AdminController::class, 'approveComment']);
            Route::delete('comments/{comment}', [AdminController::class, 'deleteComment']);
        });
    });
});