<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('users')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::post('/data', [UsersController::class, 'index'])->name('users.index.data');
    Route::delete('/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
});
