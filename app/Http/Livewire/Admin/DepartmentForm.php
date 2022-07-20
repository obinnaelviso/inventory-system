<?php

namespace App\Http\Livewire\Admin;

use App\Models\Department;
use App\Services\DepartmentService;
use Livewire\Component;

class DepartmentForm extends Component
{
    public $department;

    public $title;

    protected $listeners = [
        'updateDepartment',
        'editDepartment',
        'newDepartment' => 'resetInput',
        'deleteDepartment'
    ];

    protected $rules = [
        'title' => 'required'
    ];
    public function render()
    {
        return view('livewire.admin.department-form');
    }

    public function resetInput()
    {
        $this->Department = null;
        $this->title = null;
    }

    public function editDepartment(Department $department)
    {
        $this->Department = $department;
        $this->title = $department->title;
    }

    public function submitForm(DepartmentService $departmentService)
    {
        $validatedData = $this->validate();
        if ($this->Department) {
            $departmentService->update($this->Department, $validatedData);
            $this->emit('departmentUpdated');
        } else {
            $departmentService->create($validatedData);
            $this->emit('departmentCreated');
        }
        $this->resetInput();
    }

    public function deleteDepartment(Department $department, DepartmentService $departmentService)
    {
        $departmentService->delete($department);
        $this->resetInput();
        $this->emit('departmentDeleted');
    }
}
