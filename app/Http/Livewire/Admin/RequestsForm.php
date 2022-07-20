<?php

namespace App\Http\Livewire\Admin;

use App\Models\Request;
use App\Services\RequestService;
use Livewire\Component;

class RequestsForm extends Component
{
    public $depts;

    public $name;
    public $dept;
    public $date;
    public $request;

    protected $listeners = ['updateRequest', 'editRequest', 'deleteRequest', 'markAsCompleted'];

    protected $rules = [
        'name' => 'required',
        'dept' => 'required',
        'date' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.requests-form');
    }

    public function editRequest(Request $request)
    {
        $this->request = $request;
        $this->name = $request->name;
        $this->dept = $request->dept;
        $this->date = $request->date;
    }

    public function submitForm(RequestService $requestService) {
        $validatedData = $this->validate();
        if ($this->request) {
            $requestService->update($this->request, $validatedData);
            $this->emit('requestUpdated');
        } else {
            $requestService->create(auth()->user(), $validatedData + ['status_id' => status_processing_id()]);
            $this->emit('requestCreated');
        }
        $this->resetInput();
    }

    public function resetInput() {
        $this->name = null;
        $this->dept = null;
        $this->date = null;
    }

    public function deleteRequest(Request $request, RequestService $requestService) {
        $requestService->delete($request);
        $this->emit('requestDeleted');
    }

    public function markAsCompleted(Request $request, RequestService $requestService) {
        $requestService->update($request, ['status_id' => status_completed_id()]);
        $this->emit('requestCompleted');
    }
}
