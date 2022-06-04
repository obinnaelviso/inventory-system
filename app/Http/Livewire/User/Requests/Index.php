<?php

namespace App\Http\Livewire\User\Requests;

use App\Enums\RequestStep;
use Livewire\Component;

class Index extends Component
{
    public $step = RequestStep::LIST_REQUESTS;

    // Hold request ID
    public $r;

    public $queryString = [
        'step' => ['except' => RequestStep::LIST_REQUESTS, 'as' => 's'],
        'r'
    ];

    public $listeners = [
        'selectedRequest'
    ];

    public function render()
    {
        return view('livewire.user.requests.index');
    }

    public function selectedRequest($r)
    {
        $this->r = $r;
        $this->step = RequestStep::LIST_REQUEST_ITEMS;
        $this->dispatchBrowserEvent('intialize-table');
    }
}
