<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\RequestService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(RequestService $requestService) {
        $this->requestService = $requestService;
    }

    public function index() {
        $requests = $this->requestService->getRequests();
        return view('user.requests.index', compact('requests'));
    }
}
