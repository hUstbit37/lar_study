<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\ScoutServiceProvider;
use Laravel\Scout\Searchable;

class Test extends Model
{
    protected $table='tests';
    use Searchable;
    public function searchableAs(){
        return 'test_index';
    }
}
