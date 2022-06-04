<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\User\RequestItemController;
use App\Http\Controllers\User\StocksController;
use Illuminate\Support\Facades\Route;

Route::prefix('requests')->group(function() {
    Route::get('/', [RequestController::class, 'index'])->name('requests.index');

    // Request items
    Route::prefix('items')->group(function() {
        Route::post('{request}/', [RequestItemController::class, 'index'])->name('requests.items.index');
    });
});

Route::prefix('stocks')->group(function() {
    Route::get('/', [StocksController::class, 'index'])->name('stocks.index');
});

Route::prefix('products')->group(function() {
    Route::get('/', [StocksController::class, 'index'])->name('products.index');
});
