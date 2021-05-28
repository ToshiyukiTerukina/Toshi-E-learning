<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function relationship()
    {
        return $this->hasOne('App\Relationship');
    }

    public function lesson()
    {
        return $this->hasOne('App\Lesson');
    }

    public function activity()
    {
        return $this->morphTo();
    }
}
