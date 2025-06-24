<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'request_detail',
        'tel',
        'email',
        'deadline',
        'status',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static $statusOptions = [
        '掲載中' => '掲載中',
        '進行中' => '進行中',
        '完了' => '完了',
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
