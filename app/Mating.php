<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mating extends Model
{
    public function user() {
        $this->belongsTo('App\User');
    }

    public function female() {
        $this->belongsTo('App\Rabbit', 'female_id');
    }

    public function male() {
        $this->belongsTo('App\Rabbit', 'male_id');
    }
}
