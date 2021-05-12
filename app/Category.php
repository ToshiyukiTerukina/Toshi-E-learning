<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function words()
    {
        return $this->hasMany('App\Word');
    }

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }
}
