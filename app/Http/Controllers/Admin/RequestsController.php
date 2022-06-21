<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Services\RequestItemService;
use App\Services\RequestService;
use Illuminate\Http\Request as HttpRequest;

class RequestsController extends Controller
{

    public $requestService;
    public $requestItemService;

    public function __construct(RequestService $requestService, RequestItemService $requestItemService)
    {
        $this->requestService = $requestService;
        $this->requestItemService = $requestItemService;
    }
    public function index() {
        return view('admin.requests.index');
    }

    public function data(HttpRequest $request) {
        if ($request->expectsJson()) {
            return $this->requestService->getAllAdmin();
        }
    }

    public function items(Request $request) {
        return view('admin.requests.items', compact('request'));
    }

    public function itemsData(Request $request) {
        return $this->requestItemService->getAll($request);
    }
}
