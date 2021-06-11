<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// -- B L O G P O S T S
Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);
Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show'])->name('blog.show');
Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy'])->name('blog.destroy');
Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']);
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store'])->name('blog.store');
Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']);
Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']);

// -- U S E R S
Route::get('/user', [\App\Http\Controllers\UserController::class, 'index']);
Route::get('/user/{user}', [\App\Http\Controllers\UserController::class, 'info']);
Route::get('/users', [\App\Http\Controllers\UserController::class, 'show']);
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'edit']);
Route::put('/users/{user}', [\App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -- C O M M E N T S
Route::put('/blog/{comment}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
Route::put('/comment/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.destroy');