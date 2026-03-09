<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequestsProjectsController;
use App\Http\Middleware\VerifyAuthUser;
use Illuminate\Support\Facades\Route;

Route::withoutMiddleware([VerifyAuthUser::class])->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/create-account', [AuthController::class, 'store'])->name('create-account');

    Route::get('/confirm-account', [AuthController::class, 'confirmAccountView'])->name('confirm-account');

    Route::get('/forgot-password', [AuthController::class, 'forgotPasswordView'])->name('forgot-password');
    Route::get('/update-password', [AuthController::class, 'updatePasswordView'])->name('update-password');
});


Route::middleware([VerifyAuthUser::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/view-project/{project}', [ProjectController::class, 'index'])->name('view-project');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    
    Route::get('/requests', [RequestsProjectsController::class, 'index'])->name('requests');
    Route::get('/view-request/{request}', [RequestsProjectsController::class, 'view'])->name('view-request');
});
