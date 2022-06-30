<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class PurchasingController extends Controller
{
    public function __construct(ProductService $pr) {

    }
    public function index() {
        return view('admin.purchasing.index');
    }

    public function data(Request $request) {
        if ($request->expectsJson()) {
            return $this->stockService->getAll();
        }
    }
}
