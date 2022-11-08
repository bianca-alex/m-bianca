<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;
use App\Handlers\ImageUploadHandler;

class TopicsController extends Controller
{
    //
    public function index(Topic $topic, Request $request, $tag_search = 0)
    {
        $query = $topic->showWhere($request,$tag_search);
        $topics = $query->with('user', 'category')
 	        	    ->paginate(10);
        $categories = Category::all();
        $tags = Tag::orderBy('num','DESC')->limit(10)->get();
        return view('topics.index', compact('topics', 'categories', 'tags'));
    }

    public function indexDrafts()
    {
        $query = Topic::query()->where('is_show', '!=', 1)->where('user_id', \Auth::id());
        $topics = $query->with('user', 'category')
 	        	    ->paginate(10);
        $categories = Category::all();
        $is_draft = true;
        $tags = Tag::orderBy('num','DESC')->limit(10)->get();
        return view('topics.index', compact('topics', 'categories', 'is_draft', 'tags'));
    }

    public function privateTopic(Topic $topic)
    {
        $query = Topic::where('user_id', \Auth::id())->where('is_private', 1);
        $topics = $query->with('user', 'category')
                    ->paginate(10);
        $categories = Category::all();
        $tags = Tag::orderBy('num','DESC')->limit(10)->get();
        return view('topics.index', compact('topics', 'categories', 'tags'));
    }
    
    public function tagsSearch(Topic $topic, Request $request)
    {
        return $this->index($topic, $request, 1);
    }

    public function show(Topic $topic, Request $request)
    {
        $view_count = $topic->vzt();
        return view('topics.show', compact('topic', 'view_count'));
    }

    public function create(Topic $topic)
    {
        $tags = \DB::table('tags')->pluck('tag_name');
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories', 'tags'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->is_show = 1; 
        $topic->is_private = 0;
        if($request->is_private){
            $topic->is_private = 1;
        }
        $topic->save();
        return redirect()->route('topics.show', $topic->id)->with('success', '创建成功');
    }

    // 保存草稿
    public function storeDraft(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->is_show = 0; 
        $topic->is_private = 0;
        if($request->is_private){
            $topic->is_private = 1;
        }
        $topic->save();
        return redirect()->route('users.drafts')->with('success', '保存成功');
    }

    public function edit(Topic $topic)
    {
        $tags = \DB::table('tags')->pluck('tag_name');
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories', 'tags'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        //$topic->update($request->all());

        $this->authorize('update', $topic);
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->is_show = 1; 
        $topic->is_private = 0;
        if($request->is_private){
            $topic->is_private = 1;
        }
        $topic->save();
        return redirect()->route('topics.show', $topic->id)->with('success', '更新成功！');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        $topic->delete();

        return redirect()->route('topics.index')->with('success', '成功删除！');
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => 0,
            'message'       => '上传失败!',
            'url' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file

        if ($file = $request->file('editormd-image-file')) {
            // 保存图片到本地
            $result = $uploader->save($file, 'topics', Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['url'] = $result['path'];
                $data['message']       = "上传成功!";
                $data['success']   = 1;
            }
        }
        return $data;
    }
}
