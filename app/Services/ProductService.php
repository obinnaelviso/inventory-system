<?php

namespace App\Services;

use App\Models\Product;
use App\Models\RequestItem;
use App\Models\StockItem;
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

    public function getItem($name) {
        return Product::where('item', $name)->first();
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

    public function search($query) {
        return Product::where('item', 'like', "%{$query}%")->get();
    }

    public function updateFromStocks(StockItem $stockItem) {
        $product = $this->getItem($stockItem->item);
        if ($product) {
            $this->update($product, ['qty' => $product->qty + $stockItem->qty]);
        } else {
            $this->create(auth()->user(), [
                'item' => $stockItem->item,
                'description' => $stockItem->description,
                'qty' => $stockItem->qty,
                'unit' => $stockItem->unit,
                'category' => $stockItem->category,
                'status_id' => status_active_id()
            ]);
        }
    }

    public function updateFromRequests(RequestItem $requestItem): bool {
        $product = $this->getItem($requestItem->item);
        if ($product && ($product->qty >= $requestItem->qty)) {
            $this->update($product, ['qty' => $product->qty - $requestItem->qty]);
            return true;
        } else {
            return false;
        }
    }
}

