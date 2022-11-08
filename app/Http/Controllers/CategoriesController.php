<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Tag;
use App\Models\Category;

class CategoriesController extends Controller
{
    //
    public function show(Category $category)
    {
        $topics = Topic::where('category_id', $category->id)
                    ->where('is_show', 1)
                    ->where('is_private', 0)
                    ->paginate(10);
        // 传参变量话题和分类到模板中
        $categories = Category::all();
        $current_category_id = $category->id;
        $tags = Tag::orderBy('num','DESC')->limit(10)->get();
        return view('topics.index', compact('topics', 'categories', 'current_category_id', 'tags'));
    }
}
