<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        return view('admin.departments.index');
    }

    public function data(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->departmentService->getAll();
        }
    }
}
