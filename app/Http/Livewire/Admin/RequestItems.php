<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class RequestItems extends Component
{
    public $request;
    public function render()
    {
        return view('livewire.admin.request-items');
    }
}
