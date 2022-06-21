<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class RequestsList extends Component
{
    public $request;
    public function render()
    {
        return view('livewire.admin.requests-list');
    }
}
