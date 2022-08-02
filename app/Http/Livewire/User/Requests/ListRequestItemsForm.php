<?php

namespace App\Http\Livewire\User\Requests;

use App\Models\Request;
use App\Models\RequestItem;
use App\Services\RequestItemService;
use App\Services\RequestService;
use Livewire\Component;

class ListRequestItemsForm extends Component
{
    public Request $request;
    public $requestItem;
    public $units;

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

    protected $listeners = ['newRequestItem', 'submitRequest', 'editRequestItem', 'deleteRequestItem', 'inputFromSearch'];

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

    public function submitRequest(RequestService $requestService)
    {
        $requestService->updateStatus($this->request->id, status_processing_id());
        $this->emit('requestStatusUpdated');
        return redirect()->route('user.requests.items', $this->request->id);
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

    public function editRequestItem(RequestItem $requestItem)
    {
        $this->requestItem = $requestItem;
        $this->item = $requestItem->item;
        $this->description = $requestItem->description;
        $this->qty = $requestItem->qty;
        $this->unit = $requestItem->unit;
    }

    public function deleteRequestItem(RequestItem $requestItem, RequestItemService $requestItemService)
    {
        $requestItemService->delete($requestItem);
        $this->emit('requestItemDeleted');
    }

    public function inputFromSearch($requestItem)
    {
        $this->item = $requestItem['item'];
        $this->description = $requestItem['description'];
        $this->unit = $requestItem['unit'];
    }
}
