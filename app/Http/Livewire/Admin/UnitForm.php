<?php

namespace App\Http\Livewire\Admin;

use App\Models\Unit;
use App\Services\UnitService;
use Livewire\Component;

class UnitForm extends Component
{
    public $unit;

    public $title;

    protected $listeners = [
        'updateUnit',
        'editUnit',
        'newUnit' => 'resetInput',
        'deleteUnit'
    ];

    protected $rules = [
        'title' => 'required'
    ];
    public function render()
    {
        return view('livewire.admin.unit-form');
    }

    public function resetInput()
    {
        $this->unit = null;
        $this->title = null;
    }

    public function editUnit(Unit $unit)
    {
        $this->unit = $unit;
        $this->title = $unit->title;
    }

    public function submitForm(UnitService $unitService)
    {
        $validatedData = $this->validate();
        if ($this->unit) {
            $unitService->update($this->unit, $validatedData);
            $this->emit('unitUpdated');
        } else {
            $unitService->create($validatedData);
            $this->emit('unitCreated');
        }
        $this->resetInput();
    }

    public function deleteUnit(Unit $unit, UnitService $unitService)
    {
        $unitService->delete($unit);
        $this->resetInput();
        $this->emit('unitDeleted');
    }
}
