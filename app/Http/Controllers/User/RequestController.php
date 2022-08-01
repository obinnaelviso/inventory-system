<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Unit;
use App\Services\RequestService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $depts = Department::all();
        $units = Unit::all();
        return view('user.requests.index', compact('depts', 'units'));
    }
}
