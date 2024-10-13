<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;


// view the home page
Route::redirect('/', 'posts')->name('home');

// resource all /posts operations: CRUD
Route::resource('/posts', PostController::class);

// view specific user's blogs page
Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');

// authenticated user only access middleware
Route::middleware('auth')->group(function () {

    // view dashboard page
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    // logout user
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // email verification notice page
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');

    // route to vetify email
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');

    // route to resend verification email message to verification notice page
    Route::post('/email/verification-notification', [AuthController::class, 'verifyNotification'])->middleware('throttle:6,1')->name('verification.send');

});



// unauthenticated user only access middleware
Route::middleware('guest')->group(function () {

    // view register page
    Route::view('/register', 'auth.register')->name('register');

    // route to post user's registration data 
    Route::post('/register', [AuthController::class, 'register']);

    // view login page
    Route::view('/login', 'auth.login')->name('login');

    // route to post user's login credentials
    Route::post('/login', [AuthController::class, 'login']);

    // route to view password notice page
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

    // handle password reset form
    Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])->name('password.email');

    // route to reset password token
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->middleware('guest')->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});

