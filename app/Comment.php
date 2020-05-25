<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    // public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
    public function video()
    {
        return $this->belongsTo('App\QlVideo', 'id_video', 'id');
    }

    protected $fillable = [
        'comment_content', 'id_video', 'id_user',
    ];
}
