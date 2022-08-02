<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Request;
use App\Models\Unit;
use App\Services\RequestService;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{

    public $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function index()
    {
        $depts = Department::all();
        $units = Unit::all();
        return view('user.requests.index', compact('depts', 'units'));
    }

    public function data(HttpRequest $request)
    {
        if ($request->expectsJson()) {
            return $this->requestService->getAll();
        }
    }

    public function items(Request $request)
    {
        $units = Unit::all();
        return view('user.requests.items', compact('request', 'units'));
    }
}
