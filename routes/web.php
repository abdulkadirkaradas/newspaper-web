<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'dashboard']);

Route::prefix('register')->group(function () {
    Route::get('/', [RegisterController::class, 'view'])->name('register.view');
    Route::post('/save', [RegisterController::class, 'register'])->name('register.save');
});