<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Comment class
 */
class Comment extends Model
{

    protected $fillable = [
        'content', 'sub', 'post_id'
    ];

    // Comment can have only one user (author)
    public function user()
    {
        return $this->belongsTo('App\User', 'sub', 'sub');
    }

    // Comment can have only one post 
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
