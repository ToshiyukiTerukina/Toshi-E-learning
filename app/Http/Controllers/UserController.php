<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = Auth::user();
        return view('user/index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user/edit', compact('user'));
    }

    public function update(Request $request)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->email. ',email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $this->validate($request, $rules);

        $user = Auth::user();
        if ($request->id != $user->id) {
            return redirect()->back()->with('error', 'Could not update your profile');
        }

        if (!Hash::check($request->password, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Your Password is incorrect');
        }

        if ($this->user->updateUser($request)) {
            return redirect()->route('user.index', ['id' => $user->id])->with('success', 'Updated your profile');
        }

    }

    public function showAllUsers()
    {
        $users = $this->user->getAllUsers();
        return view('user/list', compact('users'));
    }
}
