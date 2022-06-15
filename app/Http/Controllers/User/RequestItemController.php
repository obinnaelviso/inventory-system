<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Services\RequestItemService;
use Illuminate\Http\Request as HttpRequest;

class RequestItemController extends Controller
{
    protected $requestItemService;

    public function __construct(RequestItemService $requestItemService)
    {
        $this->requestItemService = $requestItemService;
    }

    public function index(Request $request, HttpRequest $httpRequest) {
        if ($httpRequest->expectsJson()) {
            return $this->requestItemService->getAll($request);
        }
    }
}
