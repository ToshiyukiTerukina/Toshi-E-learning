<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;
use App\Word;
use App\Lesson;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Word\WordRepositoryInterface;
use App\Repositories\Lesson\LessonRepositoryInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivityRepositoryInterface $activity, WordRepositoryInterface $word, LessonRepositoryInterface $lesson)
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
