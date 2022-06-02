<?php

namespace App\Services;

use App\Models\Request;

class RequestService {

    public function __construct() {

    }

    public function getRequests(int $size = 25) {
        $requests = Request::latest()->paginate($size);
        return $requests;
    }
}
