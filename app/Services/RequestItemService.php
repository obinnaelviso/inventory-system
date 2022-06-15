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
            ->addColumn('action', function($requestItem) {
                $editBtn = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#requestItemFormModal' onclick='editRequestItem({$requestItem->id});'>Edit</button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#requestItemDeleteModal' onclick='deleteRequestItem({$requestItem->id});'>Delete</button>";
                return "{$editBtn} {$deleteBtn}";
            })
            ->addIndexColumn()
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
