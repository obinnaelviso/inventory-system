<?php

namespace App\Http\Livewire\User\Requests;

use App\Models\Request;
use App\Models\RequestItem;
use App\Services\RequestItemService;
use Livewire\Component;

class ListRequestItemsForm extends Component
{
    public Request $request;
    public $requestItem;

    public $item;
    public $description;
    public $qty;
    public $unit;

    protected $rules = [
        'item' => 'nullable|string',
        'description' => 'nullable|string',
        'qty' => 'nullable|numeric',
        'unit' => 'nullable|string',
    ];

    protected $listeners = ['newRequestItem', 'editRequestItem'];

    public function render()
    {
        return view('livewire.user.requests.list-request-items-form');
    }

    public function submitForm(RequestItemService $requestItemService)
    {
        $validatedData = $this->validate();
        if ($this->requestItem) {
            $requestItemService->update($this->requestItem, $validatedData);
            $this->emit('requestItemUpdated');
        } else {
            $requestItemService->create($this->request, $validatedData + [
                'status_id' => status_active_id(),
            ]);
            $this->emit('requestItemCreated');
        }
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->item = null;
        $this->description = null;
        $this->qty = null;
        $this->unit = null;
    }

    public function newRequestItem()
    {
        $this->requestItem = null;
        $this->resetInput();
    }

    public function editRequestItem(RequestItem $requestItem) {
        $this->requestItem = $requestItem;
        $this->item = $requestItem->item;
        $this->description = $requestItem->description;
        $this->qty = $requestItem->qty;
        $this->unit = $requestItem->unit;
    }
}
