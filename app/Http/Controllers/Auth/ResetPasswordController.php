<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'token.required' => 'Отсутствует токен для изменения пароля.',
            'email.required' => 'Поле "E-mail адрес" обязательно для заполнения.',
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'email' => 'Значение поля :attribute должно быть корректным email адресом.',
            'password.min' => 'Минимальная длина пароля - :min символов.',
            'password.confirmed' => 'Повторный пароль не соответствует первому.',
        ];
    }

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/application/rabbits';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
