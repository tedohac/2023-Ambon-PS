<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'user_npk';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_npk', 'user_password', 'user_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password'
    ];
    
    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getUserEmailAttribute($value)
    {
        return $value;
    }
}
