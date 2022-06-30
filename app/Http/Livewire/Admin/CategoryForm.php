<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Livewire\Component;

class CategoryForm extends Component
{
    public $category;

    public $title;

    protected $listeners = [
        'updateCategory',
        'editCategory',
        'newCategory' => 'resetInput',
        'deleteCategory'
    ];

    protected $rules = [
        'title' => 'required'
    ];

    public function render()
    {
        return view('livewire.admin.category-form');
    }

    public function resetInput()
    {
        $this->category = null;
        $this->title = null;
    }

    public function editCategory(Category $category)
    {
        $this->category = $category;
        $this->title = $category->title;
    }

    public function submitForm(CategoryService $categoryService)
    {
        $validatedData = $this->validate();
        if ($this->category) {
            $categoryService->update($this->category, $validatedData);
            $this->emit('categoryUpdated');
        } else {
            $categoryService->create($validatedData);
            $this->emit('categoryCreated');
        }
        $this->resetInput();
    }

    public function deleteCategory(Category $category, CategoryService $categoryService)
    {
        $categoryService->delete($category);
        $this->resetInput();
        $this->emit('categoryDeleted');
    }
}
