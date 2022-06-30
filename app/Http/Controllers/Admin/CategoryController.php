<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index() {
        return view('admin.categories.index');
    }

    public function data(Request $request) {
        if ($request->expectsJson()) {
            return $this->categoryService->getAll();
        }
    }
}
