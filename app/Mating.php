<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mating extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function female() {
        return $this->belongsTo('App\Rabbit', 'female_id');
    }

    public function male() {
        return $this->belongsTo('App\Rabbit', 'male_id');
    }
}
