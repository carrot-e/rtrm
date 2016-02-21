<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $table = 'maps';

    /**
     * get all points of the map
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points()
    {
        return $this->hasMany('App\Point');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
