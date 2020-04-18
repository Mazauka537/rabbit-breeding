<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rabbit extends Model
{
    public function matings() {
        if ($this->gender == 'f')
            return $this->matings_f();
        else
            return $this->matings_m();
    }
    public function matings_f() {
        return $this->hasMany('App\Mating', 'female_id');
    }

    public function matings_m() {
        return $this->hasMany('App\Mating', 'male_id');
    }

    public function vaccinations() {
        return $this->hasMany('App\Vaccinations');
    }

    public function user() {
        $this->belongsTo('App\User');
    }

    public function cage() {
        $this->belongsTo('App\Cage');
    }

    public function breed() {
        $this->belongsTo('App\Breed');
    }
}
