<?php

use Illuminate\Support\Facades\Route;
use Jnsdnnls\Comments\Http\AuthCPController;
use Jnsdnnls\Comments\Http\CommentCPController;


Route::prefix('comments')->group(function () {
    Route::get('/', [CommentCPController::class, 'index'])->name('comments.index');
    Route::post('/{comment_id}/edit', [CommentCPController::class, 'edit'])->name('comments.edit');
    Route::put('/{comment_id}', [CommentCPController::class, 'update'])->name('comments.update');
    Route::delete('/{comment_id}', [CommentCPController::class, 'destroy'])->name('comments.delete');
});

Route::get('/comments/users', [AuthCPController::class, 'index'])->name('comments.users.index');
// Route to ban a user
Route::post('/comments/users/{userId}/ban', [AuthCPController::class, 'ban'])->name('comments.users.ban');
