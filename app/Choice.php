<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
