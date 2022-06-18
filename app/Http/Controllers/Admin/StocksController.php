<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Services\StockItemService;
use App\Services\StockService;
use Illuminate\Http\Request;

class StocksController extends Controller
{

    public $stockService;
    public $stockItemService;

    public function __construct(StockService $stockService, StockItemService $stockItemService)
    {
        $this->stockService = $stockService;
        $this->stockItemService = $stockItemService;
    }
    public function index() {
        return view('admin.stocks.index');
    }

    public function data(Request $request) {
        if ($request->expectsJson()) {
            return $this->stockService->getAll();
        }
    }

    public function items(Stock $stock) {
        return view('admin.stocks.items', compact('stock'));
    }

    public function itemsData(Stock $stock) {
        return $this->stockItemService->getAll($stock);
    }
}
