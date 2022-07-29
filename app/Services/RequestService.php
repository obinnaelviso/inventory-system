<?php

namespace App\Services;

use App\Models\Request;
use App\Models\User;

class RequestService
{

    public function __construct()
    {
    }

    public function getAll(User $user, int $size = 25)
    {
        $requests = $user->requests()->latest()->paginate($size);
        return $requests;
    }

    public function getAllAdmin()
    {
        $requests = Request::query();

        return datatables($requests)
            ->addColumn('user', function ($request) {
                return $request->user->name;
            })
            ->addColumn('status', function ($request) {
                return "<span class='badge rounded-pill bg-{$request->status->colour[0]}'>{$request->status->title}</span>";
            })
            ->addColumn('action', function ($request) {
                $markCompleteBtn = (auth()->user()->is_user || $request->is_completed) ? '' : "<button class='btn btn-success btn-sm' onclick='selectRequest({$request->id});' title='Mark as Complete' data-bs-toggle='modal' data-bs-target='#markAsCompletedModal'><i class='bx bx-check-square me-0'></i></button>";
                $viewBtn = "<a href='/admin/requests/{$request->id}' class='btn btn-info btn-sm' onclick='selectRequest({$request->id});' title='View Items'><i class='bx bx-show me-0'></i></a>";
                $editBtn = "<button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#requestFormModal' onclick='editRequest({$request->id});' title='Edit'><i class='bx bx-edit me-0'></i></button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#requestDeleteModal' onclick='selectRequest({$request->id});' title='Delete'><i class='bx bx-trash me-0'></i></button>";
                return "{$viewBtn} {$markCompleteBtn} {$editBtn} {$deleteBtn}";
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }

    public function create(User $user, array $data)
    {
        return $user->requests()->create($data);
    }

    public function update(Request $request, array $data)
    {
        return $request->update($data);
    }

    public function delete(Request $request)
    {
        $request->delete();
    }

    public function updateStatus($requestId, $statusId)
    {
        $request = Request::find($requestId);
        $request->status_id = $statusId;
        $request->save();

        return $request;

        // TODO: send email to user
    }
}
