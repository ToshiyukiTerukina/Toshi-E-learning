<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Relationship;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(User $user, Relationship $relationship)
    {
        $this->user = $user;
        $this->relationship = $relationship;
    }

    public function index(Request $request)
    {
        if (is_null($this->user->getUserById($request->id))) {
            return redirect()->route('home')->with('error', 'does not exist');
        }
        $user = $this->user->getUserById($request->id);
        return view('user/index', compact('user'));
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        if ($request->id != $user->id) {
            return redirect()->route('home')->with('error', 'Could not edit profile of others');
        }

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

    public function follow(Request $request)
    {
        if ($request->id == Auth::id()) {
            return redirect()->back()->with('error', 'Could not follow');
        }

        if (is_null($this->user->getUserById($request->id))) {
            return redirect()->back()->with('error', 'The User you tried to follow does not exist');
        }

        if (Auth::user()->is_following($request->id)) {
            return redirect()->back()->with('error', 'Already followed');
        }

        if ($this->relationship->follow($request->id)) {
            // return redirect()->route('users.list')->with('success', 'Successfully followed');
            return redirect()->back()->with('success', 'Successfully followed');
        }
    }

    public function unfollow(Request $request)
    {

        if ($request->id == Auth::id()) {
            return redirect()->back()->with('error', 'Could not unfollow');
        }
        if (is_null($this->user->getUserById($request->id))) {
            return redirect()->back()->with('error', 'The User you tried to unfollow does not exist');
        }
        if ($this->relationship->unfollow($request->id)) {
            return redirect()->back()->with('success', 'Successfully unfollowed');
        }

    }

    public function showFollowingList($id)
    {
        $user = $this->user->getUserById($id);

        $following_list = $user->following()->get();
        return view('user/following', compact('following_list', 'user'));
    }

    public function showFollowerList($id)
    {
        $user = $this->user->getUserById($id);

        $follower_list = $user->followers()->get();
        return view('user/follower', compact('follower_list', 'user'));
    }
}
