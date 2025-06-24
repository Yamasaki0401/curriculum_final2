<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'introduction',
        'category_id',
        'user_id',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAmountLabelAttribute()
    {
        return $this->amount == 1 ? '要相談' : '不要';
    }

    public function violationReports()
    {
        return $this->hasMany(ViolationReport::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
