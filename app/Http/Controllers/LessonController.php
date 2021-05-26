<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\User;
use App\Category;
use App\Word;
use Illuminate\Contracts\Session\Session;

class LessonController extends Controller
{
    public function __construct(Lesson $lesson, User $user, Category $category, Word $word)
    {
        $this->lesson = $lesson;
        $this->user = $user;
        $this->category = $category;
        $this->word = $word;
    }

    public function index(Request $request)
    {
        if (!$this->user->getUserById($request->user_id)) {
            return redirect()->route('category.index')->with('error', 'User id does not exist');
        }

        if (!$this->category->getCategoryById($request->category_id)) {
            return redirect()->route('category.index')->with('error', 'Category id does not exist');
        }

        $lesson = $this->lesson->createLesson($request);

        return redirect()->route('quiz.show', ['lesson' => $lesson]);
    }

    public function showQuiz(Lesson $lesson)
    {
        $words = $this->word->getPaginateWordsByCategoryId($lesson->category_id);
        return view('lesson/quiz', compact('lesson', 'words'));
    }
}
