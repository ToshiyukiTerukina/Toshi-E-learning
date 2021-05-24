<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Lesson;

class QuizController extends Controller
{
    public function __construct(Answer $answer)
    {
       $this->answer = $answer;
    }
    public function answer(Request $request, Lesson $lesson)
    {
        $next_page_url = $request->next_page_url;
        if ($this->answer->answerExist($request->choice_id, $lesson->id)) {
            if ($next_page_url) {
                return redirect($next_page_url);
            }
            return redirect()->route('quiz.result', ['lesson' => $lesson]);
        }

        if ($lesson->answers->count() == $lesson->category->words->count()) {
            return redirect()->route('quiz.result', ['lesson' => $lesson])->with('error', 'Already completed');
        }


        if ($this->answer->createAnswer($request->choice_id, $lesson->id)) {
            if ($next_page_url) {
                return redirect($next_page_url);
            }
            return redirect()->route('quiz.result', ['lesson' => $lesson]);
        }
    }


    public function result(Lesson $lesson)
    {
        //Create Quizes table (quizテーブルにanswerの結果を格納)
        //lesson_id、completedは、lesson_idなanswersテーブルのレコード数がchoice_idなwordの数と同じであれば、1
        //lesson_idなchoice_idなオブジェクトのis_correctが0であれば0

        return view('lesson/result', compact('lesson'));
    }
}
