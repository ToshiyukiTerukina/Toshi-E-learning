<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function choice()
    {
        return $this->belongsTo('App\Choice');
    }
}
