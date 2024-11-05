<?php

use Illuminate\Support\Facades\Route;
use Jnsdnnls\Comments\Http\AuthController;
use Jnsdnnls\Comments\Http\CommentController;

Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store'])->middleware('auth');
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
