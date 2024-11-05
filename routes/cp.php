<?php

use Illuminate\Support\Facades\Route;
use Jnsdnnls\Comments\Http\CommentCPController;

Route::get('/comments/index', [CommentCPController::class, "index"])->name('comments.index');
