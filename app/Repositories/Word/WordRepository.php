<?php

namespace App\Repositories\Word;

use App\Word;
use App\Lesson;

class WordRepository implements WordRepositoryInterface
{

    public function __construct(Word $word, Lesson $lesson)
    {
        $this->word = $word;
        $this->lesson = $lesson;
    }

    public function getLearnedWordsByUserId($id)
    {
        $learned_lessons = $this->lesson->where('user_id', $id)->distinct()->select('category_id')->get();

        $learned_words = [];
        foreach ($learned_lessons as $lesson) {
            $wordsByLesson = $this->word->where('category_id', $lesson->category_id)->get();
            foreach ($wordsByLesson as $word) {
                array_push($learned_words, $word->toArray());
            }
        }
        return $learned_words;
    }

}
