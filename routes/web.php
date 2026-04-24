<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentaireController;
Route::get('/', [ArticleController::class, 'index']);

Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.detail');
Route::get('/videos/{id}', [VideoController::class, 'show'])->name('video.detail');
