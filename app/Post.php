<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Post class
 */
class Post extends Model
{
    protected $guarded = [];


    // Post can have many comments (one to many relationship)
    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    // post can have only one user (author)
    public function user()
    {
        return $this->belongsTo('App\User', 'sub', 'sub');
    }
    
}
