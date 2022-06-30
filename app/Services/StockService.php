<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\User;

class StockService {

    public function __construct() {

    }

    public function getAll() {
        $stocks = auth()->user()->is_admin ? Stock::query() : auth()->user()->stocks;

        return datatables($stocks)
            ->addColumn('user', function($stock) {
                return $stock->user->name;
            })
            ->addColumn('receipt_url', function($stock) {
                return $stock->url;
            })
            ->addColumn('action', function($stock) {
                $urlPrefix = auth()->user()->is_admin ? "/admin" : "";
                $viewBtn = "<a class='btn btn-primary btn-sm' href='{$urlPrefix}/stocks/{$stock->id}'>View</a>";
                $editBtn = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#stockFormModal' onclick='editStock({$stock->id});'>Edit</button>";
                $deleteBtn = auth()->user()->is_admin ? "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#stockDeleteModal' onclick='deleteStock({$stock->id});'>Delete</button>" : "";
                return "{$viewBtn} {$editBtn} {$deleteBtn}";
            })
            ->toJson();
    }

    public function create(User $user, array $data) {
        $stock = $user->stocks()->create([
            'name' => $data['name'],
            'receipt_no' => $data['receipt_no'],
            'status_id' => $data['status_id'],
        ]);
        $stock->addMedia($data['receipt_upload'])->toMediaCollection('receipt');
        return $stock;
    }

    public function update(Stock $stock, array $data) {
        $stock->update([
            'name' => $data['name'],
            'receipt_no' => $data['receipt_no'],
        ]);
        if($data['receipt_upload'] != null) {
            $stock->clearMediaCollection('receipt');
            $stock->addMedia($data['receipt_upload'])->toMediaCollection('receipt');
        }
    }

    public function delete(Stock $stock) {
        $stock->delete();
    }

    public function updateStatus($stockId, $statusId) {
        $stock = Stock::find($stockId);
        $stock->status_id = $statusId;
        $stock->save();

        return $stock;
    }
}
