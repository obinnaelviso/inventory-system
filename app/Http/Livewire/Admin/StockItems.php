<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StockItems extends Component
{
    public $stock;
    public function render()
    {
        return view('livewire.admin.stock-items');
    }
}
