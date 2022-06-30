<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Services\StockService;
use Livewire\Component;
use Livewire\WithFileUploads;

class StocksForm extends Component
{
    use WithFileUploads;

    public $stock;

    public $name;
    public $receipt_no;
    public $receipt_upload;

    protected $listeners = [
        'editStock',
        'newStock' => 'resetInput',
        'deleteStock'
    ];

    protected $rules = [
        'name' => 'required',
        'receipt_no' => 'required',
        'receipt_upload' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.stocks-form');
    }

    public function editStock(Stock $stock) {
        $this->stock = $stock;
        $this->name = $stock->name;
        $this->receipt_no = $stock->receipt_no;
        $this->receipt_upload = $stock->receipt_upload;
    }

    public function submitForm(StockService $stockService) {
        $validatedData = $this->validate();
        if ($this->stock) {
            $stockService->update($this->stock, $validatedData);
            $this->emit('stockUpdated');
        } else {
            $stockService->create(auth()->user(), $validatedData + ['status_id' => status_pending_id()]);
            $this->emit('stockCreated');
        }
        $this->resetInput();
    }

    public function resetInput() {
        $this->name = null;
        $this->receipt_no = null;
        $this->receipt_upload = null;
    }
    public function deleteStock(Stock $stock, StockService $stockService) {
        $stockService->delete($stock);
        $this->emit('stockDeleted');
    }
}
