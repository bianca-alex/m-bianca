<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Topic;
use App\Models\Category;
use App\Http\Requests\TopicRequest;

class TopicsController extends Controller
{
    //
    public function index(Topic $topic, Request $request, User $user)
    {
        $topics = $topic
                    ->with('user', 'category')
 	        	    ->paginate(10);
        $categories = Category::all();
        return view('topics.index', compact('topics', 'categories'));
    }

    public function show(Topic $topic, Request $request)
    {
        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = 1;
        $topic->save();
        return redirect()->route('topics.show', $topic->id)->with('success', '创建成功');
    }
}
