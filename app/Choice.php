<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $guarded = [
        'id'
    ];

    public static $rules = [
        // 'text' => ['required', 'string'],
        'choice1' => ['required', 'string'],
        'choice2' => ['required', 'string'],
        'choice3' => ['required', 'string'],
        'choice4' => ['required', 'string'],
        'radio_choice' => ['required'],
    ];

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function word()
    {
        return $this->belongsTo('App\Word');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getChoicesByWordId($id)
    {
        $choices = $this->where('word_id', $id)->get();
        return $choices;
    }
}
