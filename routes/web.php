<?php

use Illuminate\Support\Facades\Route;
use Jnsdnnls\Comments\Http\AuthController;
use Jnsdnnls\Comments\Http\AuthCPController;
use Jnsdnnls\Comments\Http\CommentController;

Route::prefix('comments')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store']);
});

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/comments/users/{userId}/ban', [AuthCPController::class, 'ban'])->name('comments.users.ban');
