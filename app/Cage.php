<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{

    public function rabbits() {
        return $this->hasMany('App\Rabbit');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function cageGroup() {
        return $this->belongsTo('App\CageGroup');
    }
}
