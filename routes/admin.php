<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Admin\StocksController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PurchasingController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\RequestsController;
use App\Http\Controllers\Admin\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('users')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::post('/data', [UsersController::class, 'index'])->name('users.index.data');
    Route::delete('/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
});

Route::prefix('purchasing')->group(function() {
    Route::get('/', [PurchasingController::class, 'index'])->name('purchasing.index');
    Route::get('/search', [PurchasingController::class, 'search'])->name('purchasing.search');
});

Route::prefix('requests')->group(function() {
    Route::get('/', [RequestsController::class, 'index'])->name('requests.index');
    Route::post('/data', [RequestsController::class, 'data'])->name('requests.data');
    Route::get('/{request}/generate-report', [RequestsController::class, 'generateReport'])->name('requests.generate-report');
    Route::get('/{request}', [RequestsController::class, 'items'])->name('requests.items');
    Route::post('/{request}/items', [RequestsController::class, 'itemsData'])->name('requests.items-data');
    Route::get('/{request}/search', [RequestsController::class, 'itemsSearch'])->name('requests.items-search');
});

Route::prefix('stocks')->group(function() {
    Route::get('/', [StocksController::class, 'index'])->name('stocks.index');
    Route::post('/data', [StocksController::class, 'data'])->name('stocks.data');
    Route::get('/{stock}', [StocksController::class, 'items'])->name('stocks.items');
    Route::post('/{stock}/items', [StocksController::class, 'itemsData'])->name('stocks.items-data');
});

Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/data', [CategoryController::class, 'data'])->name('categories.data');
});

Route::prefix('units')->group(function() {
    Route::get('/', [UnitController::class, 'index'])->name('units.index');
    Route::post('/data', [UnitController::class, 'data'])->name('units.data');
});

Route::prefix('reports')->group(function() {
    Route::get('/accomplished-requests', [ReportsController::class, 'accomplishedRequests'])->name('reports.accomplished-requests');
    Route::get('/pending-requests', [ReportsController::class, 'pendingRequests'])->name('reports.pending-requests');
    Route::get('/low-stocks', [ReportsController::class, 'lowStocks'])->name('reports.low-stocks');
});
