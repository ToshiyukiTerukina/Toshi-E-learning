<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Quiz');
    }

    public function activity()
    {
        return $this->morphOne('App\Activity', 'activity');
    }

    public function createLesson($request)
    {
        $lesson = '';
        DB::transaction(function () use ($request, &$lesson) {

            $lesson = $this->create([
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
            ]);

            $activity = new Activity();
            $activity->user_id = Auth::id();

            $lesson->activity()->save($activity);

        });
        return $lesson;

    }

}
