<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Activity;

class Relationship extends Model
{
    protected $guarded = [
        'id'
    ];

    public function following()
    {
        return $this->belongsTo('App\User', 'followed_id');
    }

    public function activity()
    {
        return $this->morphOne('App\Activity', 'activity');
    }

    public function follow($id)
    {
        $follow = '';

        DB::transaction(function () use($id, &$follow) {

            $follow = $this->create([
                'follower_id' => Auth::id(),
                'followed_id' => $id,
            ]);

            $activity = new Activity();
            $activity->user_id = Auth::id();

            $follow = $follow->activity()->save($activity);

        });
        return true;

    }

    public function unfollow($id)
    {
        DB::transaction(function () use($id) {

            $relationship = $this->where('follower_id', Auth::id())->where('followed_id', $id)->first();
            $relationship->delete();
            Activity::where('activity_id', $relationship->id)->delete();
        });
        return true;
    }

}
