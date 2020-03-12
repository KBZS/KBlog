<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * User class
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    // User can have many comments (one to many)
    public function comments()
    {
        return $this->hasMany('App\Comment', 'sub', 'sub');
    }

    // User can have many posts (one to many)
    public function posts()
    {
        return $this->hasMany('App\Post', 'sub', 'sub');
    }

    // User can have only one instance of additional info (one to one)
    public function additionalInfo()
    {
        return $this->hasOne('App\AdditionalInfo', 'sub', 'sub');
    }
}
