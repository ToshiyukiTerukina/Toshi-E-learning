<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        //categoriを全て取得して表示
        $users = $this->user->getAllUsers();
        return view('admin/user/index', compact('users'));

    }

    public function showCreateForm()
    {
        return view('admin/user/create');
    }

    public function create(Request $request)
    {
        $this->validate($request, $this->user::$create_rules);

        if ($this->user->adminCreateUser($request)) {
            return redirect()->route('admin.dashboard.users')->with('success', 'User created successfully');
        }

    }

    public function edit(Request $request)
    {
        if (is_null($this->user->getUserById($request->id))) {
            return redirect()->route('admin.dashboard.users')->with('error', 'does not exist');
        }
        $user = $this->user->getUserById($request->id);
        return view('admin/user/edit', compact('user'));
    }

    public function update(Request $request)
    {
        $edit_rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->email. ',email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            // 'is_admin' => Rule::in([0,1]),
            'is_admin' => ['in:0,1'],
        ];

        $this->validate($request, $edit_rules);

        if (is_null($this->user->getUserById($request->id))) {
            return redirect()->route('admin.dashboard.users')->with('error', 'does not exist');
        }

        if ($this->user->adminUpdateUser($request)) {
            return redirect()->route('admin.dashboard.users')->with('success', 'User updated successfully');
        }

    }

    public function delete(Request $request)
    {
        if (is_null($this->user->getUserById($request->id))) {
            return redirect()->route('admin.dashboard.users')->with('error', 'does not exist');
        }

        if ($this->user->adminDeleteUserById($request->id)) {
            return redirect()->route('admin.dashboard.users')->with('success', 'User deleted successfully');
        }

    }
}
