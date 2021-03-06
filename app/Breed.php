<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    public function rabbits() {
        return $this->hasMany('App\Rabbit');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
