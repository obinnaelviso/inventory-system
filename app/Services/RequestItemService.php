<?php

namespace App\Services;

use App\Models\Request;
use App\Models\RequestItem;

class RequestItemService {

    public function getAll(Request $request) {
        $requestItems = $request->requestItems;

        return datatables($requestItems)
            ->addColumn('created_at', function($requestItem) {
                return $requestItem->created_at->toDateTimeString();
            })
            ->addColumn('status', function($item) {
                return "<span class='badge rounded-pill bg-{$item->status->colour[0]}'>{$item->status->title}</span>";
            })
            ->addColumn('action', function($requestItem) {
                $processButton = $requestItem->is_completed ? '' : "<button class='btn btn-success btn-sm' data-bs-toggle='modal' title='Process request item' data-bs-target='#processRequestItemModal' onclick='selectItem({$requestItem->id});'><i class='bx bx-check-square me-0'></i></button>";
                $editBtn = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#requestItemFormModal' onclick='editRequestItem({$requestItem->id});'>Edit</button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#requestItemDeleteModal' onclick='selectItem({$requestItem->id});'>Delete</button>";
                return "{$processButton} {$editBtn} {$deleteBtn}";
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }

    public function create(Request $request, array $data) {
        return $request->requestItems()->create($data);
    }

    public function update(RequestItem $requestItem, array $data) {
        return $requestItem->update($data);
    }

    public function delete(RequestItem $requestItem) {
        $requestItem->delete();
    }
}
