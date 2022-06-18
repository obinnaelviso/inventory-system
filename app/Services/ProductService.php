<?php

namespace App\Services;

use App\Models\Product;

class ProductService {

    public function __construct() {

    }

    public function getAll() {
        $products = Product::query();

        return datatables($products)
            ->addColumn('created_at', function($product) {
                return $product->created_at->toDateTimeString();
            })
            ->addColumn('action', function($product) {
                $editBtn = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#productFormModal' onclick='editproduct({$product->id});'>Edit</button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#productDeleteModal' onclick='deleteproduct({$product->id});'>Delete</button>";
                return "{$editBtn} {$deleteBtn}";
            })
            ->toJson();
    }

    public function create(array $data) {
        auth()->user()->products()->create($data);
    }
}

