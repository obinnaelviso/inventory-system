<?php

namespace App\Services;

use App\Models\Category;

class CategoryService {
    public function getAll() {
        $categories = Category::query();
        return datatables($categories)
            ->addColumn('action', function($category) {
                $editBtn = "<button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#categoryFormModal' onclick='editCategory({$category->id});' title='Edit'><i class='bx bx-edit me-0'></i></button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#categoryDeleteModal' onclick='selectCategory({$category->id});' title='Delete'><i class='bx bx-trash me-0'></i></button>";
                return "{$editBtn} {$deleteBtn}";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create(array $data) {
        return Category::create($data + ['status_id' => status_active_id()]);
    }

    public function update(Category $category, array $data) {
        return $category->update($data);
    }

    public function delete(Category $category) {
        $category->delete();
    }
}
