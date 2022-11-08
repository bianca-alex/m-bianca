<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'body_orign', 'body', 'user_id', 'category_id', 'excerpt', 'slug', 'is_show', 'tags', 'is_private'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vzt()
    {
        visits($this)->increment();
        return visits($this)->count();
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'viewcount':
                $query->viewCount();
                break;
            default:
                $query->recent();
                break;
        }
    }

    public function getArrTagsAttribute()
    {
        if ($this->tags) {
           return explode(',', $this->tags); 
        }
        return [];
    }


    public function getOrignTagsAttribute($value)
    {
        return $this->tags;
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeViewCount($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function showWhere($request,$tag_search = 0)
    {
        // is_show
        /*if(\Auth::check()){
            $query = $this->query()->withOrder($request->order)->where('is_show', 1);
        }else{
            $query = $this->query()->withOrder($request->order)->where('is_show', 1)->where('is_private', 0);
        }*/
        $query = $this->query()->withOrder($request->order)->where('is_show', 1)->where('is_private', 0);
        if ($request->filled('search') && $tag_search){
            $query->where('tags', 'like','%'.$request->search.'%');
        }else if($request->filled('search')){
            $query->whereFullText(['tags', 'title','body_orign'],$request->search);
        }

        return $query;
    }
}
