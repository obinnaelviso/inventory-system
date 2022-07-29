<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Unit;
use App\Services\ProductService;
use Illuminate\Http\Request;

class PurchasingController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.purchasing.index', compact('categories', 'units'));
    }

    public function data(Request $request) {
        if ($request->expectsJson()) {
            return $this->stockService->getAll();
        }
    }
}
