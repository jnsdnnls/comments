<?php

use Illuminate\Support\Facades\Route;
use Jnsdnnls\Comments\Http\CommentCPController;


Route::prefix('comments')->group(function () {
    Route::get('/', [CommentCPController::class, 'index'])->name('comments.index');
    Route::post('/{comment_id}/edit', [CommentCPController::class, 'edit'])->name('comments.edit');
    Route::put('/{comment_id}', [CommentCPController::class, 'update'])->name('comments.update');
    Route::delete('/{comment_id}', [CommentCPController::class, 'destroy'])->name('comments.delete');
});
