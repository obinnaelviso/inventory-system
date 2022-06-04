<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\RequestItemService;
use Illuminate\Http\Request;

class RequestItemController extends Controller
{
    protected $requestItemService;
    
    public function __construct(RequestItemService $requestItemService)
    {
        $this->requestItemService = $requestItemService;
    }

    public function index(Request $request) {
        if ($request->expectsJson()) {
            return $this->requestItemService->getAll();
        }
    }
}
