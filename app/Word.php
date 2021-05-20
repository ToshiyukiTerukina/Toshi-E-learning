<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Choice;

class Word extends Model
{
    protected $guarded = [
        'id'
    ];

    public static $rules = [
        'question_text' => ['required', 'string'],
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    public function getWordsByCategoryId($id)
    {
        $words = $this->where('category_id', $id)->get();
        return $words;
    }

    public function getWordById($id)
    {
        $word = $this->find($id);
        return $word;
    }

    public function createWord($request)
    {
        $choice1_is = 0;
        $choice2_is = 0;
        $choice3_is = 0;
        $choice4_is = 0;

        switch ($request->radio_choice) {
            case 1:
                $choice1_is = 1;
                break;
            case 2:
                $choice2_is = 1;
                break;
            case 3:
                $choice3_is = 1;
                break;
            case 4:
                $choice4_is = 1;
                break;
        }
        DB::transaction(function () use ($request, $choice1_is, $choice2_is, $choice3_is, $choice4_is) {
            // $word = new $this;

            $word = $this->fill([
                'category_id' => $request->category_id,
                'text' => $request->question_text,
            ]);
            $word->save();
            $word_id = $word->id;

            Choice::create([
                'word_id' => $word_id,
                'text' => $request->choice1,
                'is_correct' => $choice1_is,
            ]);
            Choice::create([
                'word_id' => $word_id,
                'text' => $request->choice2,
                'is_correct' => $choice2_is,
            ]);
            Choice::create([
                'word_id' => $word_id,
                'text' => $request->choice3,
                'is_correct' => $choice3_is,
            ]);
            Choice::create([
                'word_id' => $word_id,
                'text' => $request->choice4,
                'is_correct' => $choice4_is,
            ]);
        });
        return true;
    }

    public function updateWord($request)
    {
        $choice1_is = 0;
        $choice2_is = 0;
        $choice3_is = 0;
        $choice4_is = 0;

        switch ($request->radio_choice) {
            case 1:
                $choice1_is = 1;
                break;
            case 2:
                $choice2_is = 1;
                break;
            case 3:
                $choice3_is = 1;
                break;
            case 4:
                $choice4_is = 1;
                break;
        }
        DB::transaction(function () use ($request, $choice1_is, $choice2_is, $choice3_is, $choice4_is) {
            // $word = new $this;

            $word = $this->getWordById($request->question_id);
            $word->text = $request->question_text;
            $word->save();

            $word_id = $word->id;

            $choices = Choice::where('word_id', $word_id)->get();
            $choices[0]->text = $request->choice1;
            $choices[0]->is_correct = $choice1_is;
            $choices[0]->save();

            $choices[1]->text = $request->choice2;
            $choices[1]->is_correct = $choice2_is;
            $choices[1]->save();

            $choices[2]->text = $request->choice3;
            $choices[2]->is_correct = $choice3_is;
            $choices[2]->save();

            $choices[3]->text = $request->choice4;
            $choices[3]->is_correct = $choice4_is;
            $choices[3]->save();
        });
        return true;
    }

    public function deleteWord($request)
    {

        DB::transaction(function () use ($request) {
            $choices = Choice::where('word_id', $request->question_id)->delete();

            $word = $this->getWordById($request->question_id);
            $word->delete();


        });
        return true;
    }
}

