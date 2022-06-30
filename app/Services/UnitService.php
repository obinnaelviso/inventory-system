<?php

namespace App\Services;

use App\Models\Unit;

class UnitService {
    public function getAll() {
        $units = Unit::query();
        return datatables($units)
            ->addColumn('action', function($unit) {
                $editBtn = "<button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#unitFormModal' onclick='editUnit({$unit->id});' title='Edit'><i class='bx bx-edit me-0'></i></button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#unitDeleteModal' onclick='selectUnit({$unit->id});' title='Delete'><i class='bx bx-trash me-0'></i></button>";
                return "{$editBtn} {$deleteBtn}";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create(array $data) {
        return Unit::create($data + ['status_id' => status_active_id()]);
    }

    public function update(Unit $unit, array $data) {
        return $unit->update($data);
    }

    public function delete(Unit $unit) {
        $unit->delete();
    }
}
