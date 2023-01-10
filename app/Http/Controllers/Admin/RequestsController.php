<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Request;
use App\Models\Unit;
use App\Services\RequestItemService;
use App\Services\RequestService;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class RequestsController extends Controller
{

    public $requestService;
    public $requestItemService;

    public function __construct(RequestService $requestService, RequestItemService $requestItemService)
    {
        $this->requestService = $requestService;
        $this->requestItemService = $requestItemService;
    }
    public function index()
    {
        $depts = Department::all();
        return view('admin.requests.index', compact('depts'));
    }

    public function data(HttpRequest $request)
    {
        if ($request->expectsJson()) {
            return $this->requestService->getAllAdmin();
        }
    }

    public function items(Request $request)
    {
        $units = Unit::all();
        return view('admin.requests.items', compact('request', 'units'));
    }

    public function itemsData(Request $request)
    {
        return $this->requestItemService->getAll($request);
    }

    public function printItems(Request $request) {
        $requestItems =  $request->requestItems;
        return view('export.request-items-pdf', compact('requestItems', 'request'));
    }

    public function exportItems(Request $request) {
        $requestItems =  $request->requestItems;
        $pdf = Pdf::loadView('export.request-items-pdf', compact('requestItems', 'request'));
        return $pdf->download(Str::slug($request->name.'-'.$request->dept.'-'.$request->id.'-request-items').'.pdf');
    }
}
