<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\RequestItem;
use App\Services\ProductService;
use App\Services\RequestItemService;
use Livewire\Component;

class RequestItemsForm extends Component
{
    public $request;
    public $requestItem;
    public $units;

    public $item;
    public $description;
    public $qty;
    public $unit;

    protected $rules = [
        'item' => 'required',
        'description' => 'required',
        'qty' => 'required',
        'unit' => 'required',
    ];

    protected $listeners = [
        'editRequestItem',
        'newRequestItem' => 'resetInput',
        'deleteRequestItem',
        'processRequestItem',
        'inputFromSearch'
    ];

    public function render()
    {
        return view('livewire.admin.request-items-form');
    }

    public function editRequestItem(RequestItem $requestItem)
    {
        $this->requestItem = $requestItem;
        $this->item = $requestItem->item;
        $this->description = $requestItem->description;
        $this->qty = $requestItem->qty;
        $this->unit = $requestItem->unit;
    }

    public function submitForm(RequestItemService $requestItemService)
    {
        $validatedData = $this->validate();
        if ($this->requestItem) {
            $requestItemService->update($this->requestItem, $validatedData);
            $this->emit('requestItemUpdated');
        } else {
            $requestItemService->create($this->request, $validatedData + ['status_id' => status_processing_id()]);
            $this->emit('requestItemCreated');
        }
        $this->resetInput();
    }

    public function deleteRequestItem(RequestItem $requestItem, RequestItemService $requestItemService)
    {
        $requestItemService->delete($requestItem);
        $this->emit('requestItemDeleted');
    }

    public function resetInput()
    {
        $this->item = null;
        $this->description = null;
        $this->qty = null;
        $this->unit = null;
    }

    public function processRequestItem(RequestItem $requestItem, RequestItemService $requestItemService, ProductService $productService)
    {
        $requestAvailable = $productService->updateFromRequests($requestItem);
        if ($requestAvailable) {
            $requestItemService->update($requestItem, ['status_id' => status_completed_id()]);
            $this->emit('requestItemProcessed');
        } else {
            $requestItemService->update($requestItem, ['status_id' => status_pending_id()]);
            $this->emit('requestItemNotAvailable');
        }
    }

    public function inputFromSearch(Product $product)
    {
        $this->item = $product->item;
        $this->description = $product->description;
        $this->unit = $product->unit;
    }
}
