<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }
    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }
    public function isFriend($userId) 
    {
        return (boolean) $this->friendsOfMine()->where('friend_id', $userId)->first(['id']);
    }
    public function friend(){
        return $this->hasMany('App\Friend', 'user_id','id');
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