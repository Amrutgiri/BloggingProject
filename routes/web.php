<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-post', [AuthController::class, 'loginPost'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('forgot.password.post');
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');

Route::get('/404', function () {
    return view('404');
})->name('404');
// Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::middleware(['auth', 'user'])->group(function () {

    Route::get('user/home', [UserController::class, 'index'])->name('user.home');
    Route::get('my/posts', [UserController::class, 'myPosts'])->name('my.post');
    Route::get('create/post', [UserController::class, 'createPost'])->name('create.post');
    Route::get('edit/post/{id}', [UserController::class, 'editPost'])->name('edit.post');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home');
});
