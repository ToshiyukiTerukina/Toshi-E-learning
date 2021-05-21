<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [
        'id'
    ];

    public static $rules = [
        'title' => ['required', 'string'],
        'description' => ['required', 'string'],
    ];

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function words()
    {
        return $this->hasMany('App\Word');
    }

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    public function getAllCategories()
    {
        $categories = $this->all();
        return $categories;
    }

    public function getCategoryById($id)
    {
        $category = $this->find($id);
        return $category;
    }

    public function createCategory($request)
    {
        $this->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return true;
    }

    public function updateCategory($request)
    {
        $category = $this->getCategoryById($request->category_id);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();
        return true;
    }

    public function deleteCategoryById($id)
    {
        $category = $this->getCategoryById($id);
        $category->delete();
        return true;
    }
}
