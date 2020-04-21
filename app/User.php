<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cages()
    {
        return $this->hasMany('App\Cage');
    }

    public function breeds()
    {
        return $this->hasMany('App\Breed');
    }

    public function rabbits()
    {
        return $this->hasMany('App\Rabbit');
    }

    public function matings()
    {
        return $this->hasMany('App\Mating');
    }

    public function vaccinations()
    {
        return $this->hasMany('App\Vaccination');
    }

    public function reminders()
    {
        return $this->hasMany('App\Reminder');
    }
}
