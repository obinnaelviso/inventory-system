<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function index() {
        return view('user.stocks.index');
    }
}
