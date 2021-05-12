<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }
}
