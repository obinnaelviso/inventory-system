<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\RequestService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index() {
        return view('user.requests.index');
    }
}
