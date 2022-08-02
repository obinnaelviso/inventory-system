<?php

namespace App\Http\Livewire\User\Requests;

use App\Models\Request;
use App\Services\RequestService;
use Livewire\Component;

class RequestForm extends Component
{
    public $name;
    public $dept;
    public $date;
    public $request;

    public $depts = [];

    protected $listeners = ['updateRequest', 'editRequest', 'deleteRequest'];

    protected $rules = [
        'name' => 'required',
        'dept' => 'required',
        'date' => 'required',
    ];

    public function render()
    {
        return view('livewire.user.requests.request-form');
    }

    public function editRequest(Request $request)
    {
        $this->request = $request;
        $this->name = $request->name;
        $this->dept = $request->dept;
        $this->date = $request->date;
    }

    public function submitForm(RequestService $requestService)
    {
        $validatedData = $this->validate();
        if ($this->request) {
            $requestService->update($this->request, $validatedData);
            $this->emit('requestUpdated');
        } else {
            $requestService->create(auth()->user(), $validatedData + ['status_id' => status_pending_id()]);
            $this->emit('requestCreated');
        }
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = null;
        $this->dept = null;
        $this->date = null;
    }

    public function updateRequest(Request $request)
    {
        $this->request = $request;
        $this->name = $request->name;
        $this->dept = $request->dept;
        $this->date = $request->date;
    }

    public function deleteRequest(Request $request, RequestService $requestService)
    {
        $requestService->delete($request);
        $this->emit('requestDeleted');
    }
}
