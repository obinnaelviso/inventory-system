<?php

namespace App\Http\Livewire\Admin;

use App\Models\StockItem;
use App\Services\ProductService;
use App\Services\StockItemService;
use Livewire\Component;

class StockItemsForm extends Component
{
    public $stock;
    public $stockItem;
    public $units = [];
    public $categories = [];

    public $item;
    public $description;
    public $qty;
    public $unit = "";
    public $category = "";

    protected $rules = [
        'item' => 'required',
        'description' => 'required',
        'qty' => 'required',
        'unit' => 'required',
        'category' => 'required'
    ];

    protected $listeners = [
        'editStockItem',
        'newStockItem' => 'resetInput',
        'deleteStockItem',
        'addItemToProducts',
        'inputFromSearch'
    ];

    public function render()
    {
        return view('livewire.admin.stock-items-form');
    }

    public function editStockItem(StockItem $stockItem)
    {
        $this->stockItem = $stockItem;
        $this->item = $stockItem->item;
        $this->description = $stockItem->description;
        $this->qty = $stockItem->qty;
        $this->unit = $stockItem->unit;
        $this->category = $stockItem->category;
    }

    public function submitForm(StockItemService $stockItemService)
    {
        $validatedData = $this->validate();
        if ($this->stockItem) {
            $stockItemService->update($this->stockItem, $validatedData);
            $this->emit('stockItemUpdated');
        } else {
            $stockItemService->create($this->stock, $validatedData + ['status_id' => status_pending_id()]);
            $this->emit('stockItemCreated');
        }
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->item = null;
        $this->description = null;
        $this->qty = null;
        $this->unit = null;
        $this->category = null;
    }

    public function deleteStockItem(StockItem $stockItem, StockItemService $stockItemService)
    {
        $stockItemService->delete($stockItem);
        $this->emit('stockItemDeleted');
    }

    // public function markAsCompleted(StockItem $stockItem, StockItemService $stockItemService) {
    //     $stockItemService->update($stockItem, ['status_id' => status_completed_id()]);
    //     $this->emit('stockItemCompleted');
    // }

    public function addItemToProducts(StockItem $stockItem, StockItemService $stockItemService, ProductService $productService)
    {
        $productService->updateFromStocks($stockItem);
        $stockItemService->update($stockItem, ['status_id' => status_completed_id()]);
        $this->emit('stockItemAddedToProducts');
    }

    public function inputFromSearch($requestItem)
    {
        $this->item = $requestItem['item'];
        $this->description = $requestItem['description'];
        $this->unit = $requestItem['unit'];
        $this->category = $requestItem['category'];
    }
}
