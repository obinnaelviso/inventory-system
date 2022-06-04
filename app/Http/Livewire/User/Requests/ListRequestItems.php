<?php

namespace App\Http\Livewire\User\Requests;

use App\Models\Request;
use Livewire\Component;

class ListRequestItems extends Component
{
    public $request;

    public $listeners = [
        'initializeTable' => '$refresh'
    ];

    public function mount(Request $request)
    {
        $this->request = $request;
    }

    public function render()
    {
        return view('livewire.user.requests.list-request-items');
    }
}
