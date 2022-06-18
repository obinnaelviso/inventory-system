<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockItem;

class StockItemService {

    public function __construct() {

    }


    public function getAll(Stock $stock) {
        $items = $stock->items;

        return datatables($items)
            ->addColumn('status', function($item) {
                return "<span class='badge rounded-pill bg-{$item->status->colour[0]}'>{$item->status->title}</span>";
            })
            ->addColumn('action', function($item) {
                $markCompleteBtn = $item->is_completed ? '' : "<button class='btn btn-success btn-sm' onclick='selectItem({$item->id});' title='Mark as Complete' data-bs-toggle='modal' data-bs-target='#markAsCompletedModal'><i class='bx bx-check-square me-0'></i></button>";
                $addToProducts = $item->is_completed ? '' : "<button class='btn btn-warning btn-sm' onclick='selectItem({$item->id});' title='Add to Products' data-bs-toggle='modal' data-bs-target='#addToProductsModal'><i class='bx bx-plus me-0'></i></button>";
                $editBtn = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#stockItemFormModal' onclick='editStockItem({$item->id});'>Edit</button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#stockItemDeleteModal' onclick='selectItem({$item->id});'>Delete</button>";
                return "{$markCompleteBtn} {$addToProducts} {$editBtn} {$deleteBtn}";
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }

    public function create(Stock $stock, array $data) {
        $stockItem = $stock->items()->create($data);
        return $stockItem;
    }

    public function update(StockItem $stockItem, array $data) {
        $stockItem->update($data);
    }

    public function delete(StockItem $stockItem) {
        $stockItem->delete();
    }
}
