<?php

namespace App\Http\Livewire\User\Requests;

use App\Models\Request;
use App\Services\RequestService;
use Livewire\Component;

class ListRequests extends Component
{
    protected $listeners = [
        'requestCreated' => '$refresh',
        'requestUpdated' => '$refresh',
    ];
    public function render()
    {
        return view('livewire.user.requests.list-requests');
    }

    public function getRequestsProperty(RequestService $requestService) {
        return $requestService->getAll();
    }
}
