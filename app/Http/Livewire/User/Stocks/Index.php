<?php

namespace App\Http\Livewire\User\Stocks;

use App\Enums\StockStep;
use Livewire\Component;

class Index extends Component
{
    public $step = StockStep::LIST_STOCKS;

    // Hold stock ID
    public $st;

    public $queryString = [
        'step' => ['except' => StockStep::LIST_STOCKS, 'as' => 's'],
        'st'
    ];

    public $listeners = [
        'selectedStock'
    ];

    public function render()
    {
        return view('livewire.user.stocks.index');
    }

    public function selectedStock($st)
    {
        $this->st = $st;
        $this->step = StockStep::LIST_STOCK_ITEMS;
    }
}
