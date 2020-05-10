<?php

namespace App;

use App\Mail\PasswordResetLink;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Отправка уведомления о сбросе пароля.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $user = $this;
        Mail::send('mails.passwordResetLink', ['token' => $token, 'email' => $user->email], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Сброс пароля - Rabbit-breeding');
        });
    }

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

    public function defaultNotifies()
    {
        return $this->hasMany('App\DefaultNotify');
    }

    public function cageGroups()
    {
        return $this->hasMany('App\CageGroup');
    }
}
