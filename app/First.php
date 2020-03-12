<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class First extends Model
{   
    // Many to Many relationship
    public function seconds()
    {
        return $this->belongsToMany('App\Second');
    }
}
