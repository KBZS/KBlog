<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Second extends Model
{   
    // Many to Many relationship
    public function firsts()
    {
        return $this->belongsToMany('App\First');
    }
}
