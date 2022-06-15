<?php

namespace App\Services;

use App\Models\Request;
use App\Models\User;

class RequestService {

    public function __construct() {

    }

    public function getAll(int $size = 25) {
        $requests = Request::latest()->paginate($size);
        return $requests;
    }

    public function create(User $user, array $data) {
        return $user->requests()->create($data);
    }

    public function update(Request $request, array $data) {
        return $request->update($data);
    }

    public function delete(Request $request) {
        $request->delete();
    }

    public function updateStatus($requestId, $statusId) {
        $request = Request::find($requestId);
        $request->status_id = $statusId;
        $request->save();

        return $request;

        // TODO: send email to user
    }
}
