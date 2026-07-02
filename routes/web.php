<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);
Route::post('posts/{post}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');

Route::get('/', function () {
    return redirect('/posts');
});