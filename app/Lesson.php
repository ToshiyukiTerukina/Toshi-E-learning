<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
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
}
