<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    public function activitie()
    {
        return $this->belongsTo('App\Activity');
    }
}
