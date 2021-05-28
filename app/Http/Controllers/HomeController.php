<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\Word;
use App\Lesson;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, Word $word, Lesson $lesson)
    {
        $this->activity = $activity;
        $this->word = $word;
        $this->lesson = $lesson;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $activities = $this->activity->getAllActivity();
        $learned_lessons = $this->lesson->getLearnedLessonsByUserId($user->id);

        $learned_words = $this->word->getLearnedWordsByUserId($user->id);

        return view('home', compact('user', 'activities', 'learned_lessons', 'learned_words'));
    }
}
