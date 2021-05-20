<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class AdminCategoryController extends Controller
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        //categoriを全て取得して表示
        $categories = $this->category->getAllCategories();
        return view('admin/category/index', compact('categories'));

    }

    public function showCreateForm()
    {
        return view('admin/category/create');
    }

    public function create(Request $request)
    {
        $this->validate($request, $this->category::$rules);

        if ($this->category->createCategory($request)) {
            return redirect()->route('admin.dashboard')->with('success', 'Category created successfully');
        }

    }

    public function edit(Request $request)
    {
        if (is_null($this->category->getCategoryById($request->category_id))) {
            return redirect()->route('admin.dashboard')->with('error', 'does not exist');
        }
        $category = $this->category->getCategoryById($request->category_id);
        return view('admin/category/edit', compact('category'));
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->category::$rules);

        if (is_null($this->category->getCategoryById($request->category_id))) {
            return redirect()->route('admin.dashboard')->with('error', 'does not exist');
        }

        if ($this->category->updateCategory($request)) {
            return redirect()->route('admin.dashboard')->with('success', 'Category updated successfully');
        }

    }

    public function delete(Request $request)
    {
        if (is_null($this->category->getCategoryById($request->category_id))) {
            return redirect()->route('admin.dashboard')->with('error', 'does not exist');
        }

        if ($this->category->deleteCategoryById($request->category_id)) {
            return redirect()->route('admin.dashboard')->with('success', 'Category deleted successfully');
        }
    }

}
