<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $guarded=[];

    public function tweet()
    {
        return $this->hasOne('App\Tweet');
    }
}
