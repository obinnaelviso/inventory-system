<?php

namespace App\Services;

use App\Models\User;

class UsersService {

    public function getUserData() {
        $users = User::query();
        return datatables($users)
            ->addColumn('name', function($user) {
                return $user->name;
            })
            ->editColumn('created_at', function($user) {
                return $user->created_at->toDateTimeString();
            })
            ->addColumn('role', function($user) {
                $roles = $user->getRoleNames();
                $roleName = '';
                foreach ($roles as $role) {
                    $roleName .= ucfirst($role) . ', ';
                }
                return substr(trim($roleName), -1) == ',' ? substr($roleName, 0, -2) : $roleName;
            })
            ->addColumn('action', function($user) {
                $editBtn = "<button class='btn btn-info btn-sm' onclick='editUser({$user->id});'>Edit</button>";
                $deleteBtn = "<button class='btn btn-danger btn-sm' onclick='deleteUser({$user->id});'>Delete</button>";
                return "{$editBtn} {$deleteBtn}";
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function createUser(string $first_name, string $last_name, string $email, string $password, string $role) {
        return User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => bcrypt($password),
        ])->assignRole($role);
    }

    public function updateUser(User $user, string $first_name, string $last_name, string $email, string $password, string $role) {
        $user->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
        ]);
        if ($password) {
            $user->update([
                'password' => bcrypt($password),
            ]);
        }
        $user->syncRoles($role);
    }

    public function deleteUser(User $user) {
        $user->delete();
    }
}
