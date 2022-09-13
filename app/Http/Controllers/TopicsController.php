<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Topic;

class TopicsController extends Controller
{
    //
    public function index(Topic $topic, Request $request, User $user)
    {
        $topics = $topic
                    ->with('user', 'category')
 	        	    ->paginate(10);
        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic, Request $request)
    {
        return view('topics.show', compact('topic'));
    }
}
