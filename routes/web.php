<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::prefix('register')->group(function () {
    Route::get('/', [RegisterController::class, 'view'])->name('register.view');
    Route::post('/save', [RegisterController::class, 'register'])->name('register.save');
});

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'view'])->name('login.view');
    Route::post('/login', [LoginController::class, 'login'])->name('login.login');
});