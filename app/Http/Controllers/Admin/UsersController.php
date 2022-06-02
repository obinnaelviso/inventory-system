<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $usersService;

    public function __construct(UsersService $usersService) {
        $this->usersService = $usersService;
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->usersService->getUserData();
        }
        return view('admin.users.index');
    }

    public function destroy(User $user, Request $request) {
        if ($request->expectsJson()) {
            $this->usersService->deleteUser($user);
            return apiSuccess([], 'User deleted successfully');
        }
    }
}
