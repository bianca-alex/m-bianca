<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'body_orign', 'body', 'user_id', 'category_id', 'excerpt', 'slug', 'is_show'];

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

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeViewCount($query)
    {
        return $query->orderBy('view_count', 'desc');
    }
}
