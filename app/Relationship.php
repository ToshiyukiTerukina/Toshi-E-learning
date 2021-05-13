<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Relationship extends Model
{
    protected $guarded = [
        'id'
    ];

    public function activitie()
    {
        return $this->belongsTo('App\Activity');
    }

    public function follow($id)
    {
        $this->create([
            'follower_id' => Auth::id(),
            'followed_id' => $id,
        ]);
        return true;
    }

    public function unfollow($id)
    {
        $relationship = $this->where('follower_id', Auth::id())->where('followed_id', $id)->first();
        $relationship->delete();
        return true;
    }

}
