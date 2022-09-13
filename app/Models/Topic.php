<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'view_count', 'order', 'excerpt', 'slug'];
}
