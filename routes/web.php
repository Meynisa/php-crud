<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = [];

    // auth()->check() ? $posts = auth()->user()->usersPosts()->latest()->get(): $posts = Post::all();
    if (auth()->check()) {
        $posts = auth()->user()->usersPosts()->latest()->get();
    } else {
        $posts = Post::all()->sortDesc();
    }

    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/create-post', [PostController::class, 'createPost']);

Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'editPost']);

Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);