<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function getAll()
    {
        $departments = Department::query();
        return datatables($departments)
            ->addColumn('action', function ($department) {
                $editBtn = "<button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#departmentFormModal' onclick='editDepartment({$department->id});' title='Edit'><i class='bx bx-edit me-0'></i></button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#departmentDeleteModal' onclick='selectDepartment({$department->id});' title='Delete'><i class='bx bx-trash me-0'></i></button>";
                return "{$editBtn} {$deleteBtn}";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create(array $data)
    {
        return Department::create($data + ['status_id' => status_active_id()]);
    }

    public function update(Department $department, array $data)
    {
        return $department->update($data);
    }

    public function delete(Department $department)
    {
        $department->delete();
    }
}
