<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function rabbit() {
        return $this->belongsTo('App\Rabbit');
    }
}
