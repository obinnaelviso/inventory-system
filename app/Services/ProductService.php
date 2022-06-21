<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;

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
                $editBtn = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#productFormModal' onclick='editProduct({$product->id});'>Edit</button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#productDeleteModal' onclick='selectItem({$product->id});'>Delete</button>";
                return "{$editBtn} {$deleteBtn}";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create(User $user, array $data) {
        $user->products()->create($data);
    }

    public function update(Product $product, array $data) {
        $product->update($data);
    }

    public function delete(Product $product) {
        $product->delete();
    }
}

