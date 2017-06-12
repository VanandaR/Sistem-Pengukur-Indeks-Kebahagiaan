<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $guarded=[];

    public function classification()
    {
        return $this->hasOne('App\Classification','id_tweet');
    }
}
