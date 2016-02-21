<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'points';

    public function map()
    {
        return $this->belongsTo('App\Map');
    }

}
