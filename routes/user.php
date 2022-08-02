<?php

use App\Http\Controllers\Admin\PurchasingController;
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\User\RequestItemController;
use App\Http\Controllers\User\StocksController;
use Illuminate\Support\Facades\Route;

Route::prefix('purchasing')->group(function() {
    Route::get('/', [PurchasingController::class, 'index'])->name('purchasing.index');
});

Route::prefix('requests')->group(function() {
    Route::get('/', [RequestController::class, 'index'])->name('requests.index');
    Route::get('/{request}', [RequestController::class, 'items'])->name('requests.items');
    Route::post('/data', [RequestController::class, 'data'])->name('requests.data');

    // Request items
    Route::prefix('items')->group(function() {
        Route::post('{request}/', [RequestItemController::class, 'index'])->name('requests.items.index');
    });
});

Route::prefix('stocks')->group(function() {
    Route::get('/', [StocksController::class, 'index'])->name('stocks.index');
});

Route::prefix('stocks')->group(function() {
    Route::get('/', [StocksController::class, 'index'])->name('stocks.index');
    Route::post('/data', [StocksController::class, 'data'])->name('stocks.data');
    Route::get('/{stock}', [StocksController::class, 'items'])->name('stocks.items');
    Route::post('/{stock}/items', [StocksController::class, 'itemsData'])->name('stocks.items-data');
});
