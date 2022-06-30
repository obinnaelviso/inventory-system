<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public $unitController;

    public function __construct(UnitService $unitService) {
        $this->unitService = $unitService;
    }

    public function index() {
        return view('admin.units.index');
    }

    public function data(Request $request) {
        if ($request->expectsJson()) {
            return $this->unitService->getAll();
        }
    }

}
