<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Admin\StocksController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PurchasingController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('users')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::post('/data', [UsersController::class, 'index'])->name('users.index.data');
    Route::delete('/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
});

Route::prefix('purchasing')->group(function() {
    Route::get('/', [PurchasingController::class, 'index'])->name('purchasing.index');
});

Route::prefix('stocks')->group(function() {
    Route::get('/', [StocksController::class, 'index'])->name('stocks.index');
    Route::post('/data', [StocksController::class, 'data'])->name('stocks.data');
    Route::get('/{stock}', [StocksController::class, 'items'])->name('stocks.items');
    Route::post('/{stock}/items', [StocksController::class, 'itemsData'])->name('stocks.items-data');
});
