<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class QlVideo extends Model
{
    use Searchable;
    protected $table = 'ql_video';
//    public $timestamps = true;
    protected $primaryKey = 'id';
    public function searchableAs()
    {
        return 'video_index';
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment', 'id_video', 'id');
    }

    protected $fillable = [
        'id_user', 'video_name',
    ];
}
