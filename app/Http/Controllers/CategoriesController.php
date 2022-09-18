<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    //
    public function show(Category $category)
    {
        $topics = Topic::where('category_id', $category->id)->paginate(10);
        // 传参变量话题和分类到模板中
        $categories = Category::all();
        $current_category_id = $category->id;
        return view('topics.index', compact('topics', 'categories', 'current_category_id'));
    }
}
