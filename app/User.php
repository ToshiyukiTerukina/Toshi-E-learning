<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'first_name', 'last_name', 'email', 'password', 'is_admin'
    // ];
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $create_rules = [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
    ];


    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'relationships', 'followed_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany('App\User', 'relationships', 'follower_id', 'followed_id');
    }

    public function is_following($user_id)
    {
        if ($this->following()->where('followed_id', $user_id)->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($request)
    {
        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();
        return true;
    }

    public function getAllUsers()
    {
        $users = $this->all();
        return $users;
    }

    public function getUserById($id)
    {
        $user = $this->find($id);
        return $user;
    }

    //For Admin
    public function adminCreateUser($request)
    {
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
        ]);
        return true;
    }

    public function adminUpdateUser($request)
    {
        $user = $this->getUserById($request->id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->is_admin;
        $user->save();

        return true;
    }

    public function adminDeleteUserById($id) {
        $user = $this->getUserById($id);
        $user->delete();
        return true;


    }

}
