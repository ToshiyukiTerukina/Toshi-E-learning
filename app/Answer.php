<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = ['id'];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function choice()
    {
        return $this->belongsTo('App\Choice');
    }

    public function createAnswer($choice_id, $lesson_id)
    {
        $this->create([
            'choice_id' => $choice_id,
            'lesson_id' => $lesson_id,
        ]);
        return true;
    }

    public function answerExist($choice_id, $lesson_id)
    {
        return $this->where('choice_id', $choice_id)->where('lesson_id', $lesson_id)->first();
    }
}
