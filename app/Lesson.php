<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function activitie()
    {
        return $this->belongsTo('App\Activity');
    }

    public function createLesson($request)
    {
        $lesson = $this->create([
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);
        return $lesson;
    }
}
