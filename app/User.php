<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{ 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'username', 'email', 'password', 'firstname', 'lastname', 'phoneNo',
    ];

}
