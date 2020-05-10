<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CageGroup extends Model
{
    public function cages() {
        return $this->hasMany('App\Cage');
    }

    public function rabbits() {
        return $this->hasManyThrough('App\Rabbit', 'App\Cage');
    }
}
