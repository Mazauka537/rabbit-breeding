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
        return $this->hasMany('App\Vaccination');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function cage() {
        return $this->belongsTo('App\Cage');
    }

    public function breed() {
        return $this->belongsTo('App\Breed');
    }
}
