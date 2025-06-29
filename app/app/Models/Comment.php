<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LDAP\Result;

class Comment extends Model
{
    protected $fillable = ['user_id', 'body'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
