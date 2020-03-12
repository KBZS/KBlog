<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'sub', 'sub');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_id', 'id');
    }
}
