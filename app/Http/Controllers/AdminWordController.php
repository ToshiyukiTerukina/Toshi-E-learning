<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Category;
use App\Choice;
use Illuminate\Support\Facades\DB;

class AdminWordController extends Controller
{
    public function __construct(Word $word, Category $category, Choice $choice)
    {
        $this->word = $word;
        $this->category = $category;
        $this->choice = $choice;
    }
    public function index(Request $request)
    {
        if (is_null($this->category->getCategoryById($request->category_id))) {
            return redirect()->back()->with('error', 'does not exist');
        }

        $words = $this->word->getWordsByCategoryId($request->category_id);
        $category = $this->category->getCategoryById($request->category_id);
        return view('admin/question/index', compact('words', 'category'));
    }

    public function showCreateForm($id)
    {
        if (is_null($this->category->getCategoryById($id))) {
            return redirect()->back()->with('error', 'does not exist');
        }
        $category = $this->category->getCategoryById($id);

        return view('admin/question/create', compact('category'));
    }

    public function create(Request $request)
    {
        $this->validate($request, $this->word::$rules);
        $this->validate($request, $this->choice::$rules);

        if (is_null($this->category->getCategoryById($request->category_id))) {
            return redirect()->back()->with('error', 'does not exist');
        }

        if ($this->word->createWord($request)) {
            return redirect()->route('admin.question.index', ['category_id' => $request->category_id])->with('success', 'Question created');
        }

    }

    public function edit(Request $request)
    {
        if (is_null($this->category->getCategoryById($request->category_id))) {
            return redirect()->back()->with('error', 'The Category does not exist');
        }

        if (is_null($this->word->getWordById($request->question_id))) {
            return redirect()->back()->with('error', 'The question does not exist');
        }

        $category = $this->category->getCategoryById($request->category_id);
        $word = $this->word->getWordById($request->question_id);
        $choices = $this->choice->getChoicesByWordId($request->question_id);

        return view('admin/question/edit', compact('category', 'word', 'choices'));
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->word::$rules);
        $this->validate($request, $this->choice::$rules);

        if (is_null($this->category->getCategoryById($request->category_id))) {
            return redirect()->back()->with('error', 'The Category does not exist');
        }

        if (is_null($this->word->getWordById($request->question_id))) {
            return redirect()->back()->with('error', 'The question does not exist');
        }

        if ($this->word->updateWord($request)) {
            return redirect()->route('admin.question.index', ['category_id' => $request->category_id])->with('success', 'Question updated');
        }
    }

    public function delete(Request $request)
    {
        if (is_null($this->category->getCategoryById($request->category_id))) {
            return redirect()->back()->with('error', 'The Category does not exist');
        }

        if (is_null($this->word->getWordById($request->question_id))) {
            return redirect()->back()->with('error', 'The question does not exist');
        }

        if ($this->word->deleteWord($request)) {
            return redirect()->route('admin.question.index', ['category_id' => $request->category_id])->with('success', 'Question deleted');
        }
    }
}
