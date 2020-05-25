<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function video()
    {
       return $this->hasMany('App\QlVideo', 'id_user', 'id');
    }
    public function comment()
    {
       return $this->hasMany('App\Comment', 'id_user', 'id');
    }
    
    public function comment_s(){
        return $this->hasManyThrough('App\Comment', 'App\QlVideo', 'id_user', 'id_video', 'id');
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
