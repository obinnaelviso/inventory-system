<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Services\UsersService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public $user;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role = "";

    protected $listeners = ['editUser', 'newUser'];

    protected $newUserRules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|string|max:255|in:admin,user',
    ];

    protected function updateUserRules() {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|max:255|in:admin,user',
        ];
    }

    public function render()
    {
        return view('livewire.admin.users.form');
    }

    public function newUser() {
        $this->resetInput();
    }

    public function submitForm(UsersService $usersService) {
        if ($this->user) {
            $this->validate($this->updateUserRules());
            $usersService->updateUser($this->user, $this->first_name, $this->last_name, $this->email, $this->password, $this->role);
            $this->emit('userUpdated');
        } else {
            $this->validate($this->newUserRules);
            $usersService->createUser($this->first_name, $this->last_name, $this->email, $this->password, $this->role);
            $this->emit('userCreated');
            $this->resetInput();
        }
    }

    public function resetInput() {
        $this->first_name = "";
        $this->last_name = "";
        $this->email = "";
        $this->password = "";
        $this->password_confirmation = "";
        $this->role = "";
    }

    public function editUser(User $user) {
        $this->user = $user;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->password = "";
        $this->password_confirmation = "";
        $this->role = $user->getRoleNames()[0];
    }
}
