<?php

namespace App\Http\Livewire\User\Requests;

use App\Models\Request;
use App\Models\RequestItem;
use App\Services\RequestItemService;
use Livewire\Component;

class ListRequestItems extends Component
{
    public $request;
    public $units;

    public $listeners = [
        'initializeTable' => '$refresh',
        'requestStatusUpdated'
    ];

    public function mount(Request $request)
    {
        $this->request = $request;
    }

    public function requestStatusUpdated(Request $request)
    {
        $this->request = $request;
    }

    public function render()
    {
        return view('livewire.user.requests.list-request-items');
    }
}
