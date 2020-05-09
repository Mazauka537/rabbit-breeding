<?php

namespace App\Http\Controllers\Auth;

use App\DefaultNotify;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $defaultReminders = [
            [
                'user_id' => $user->id,
                'days' => '7',
                'text' => 'Контрольная случка',
            ], [
                'user_id' => $user->id,
                'days' => '15',
                'text' => 'Проверка беременности',
            ], [
                'user_id' => $user->id,
                'days' => '25',
                'text' => 'Выставление маточника',
            ], [
                'user_id' => $user->id,
                'days' => '45',
                'text' => 'Повторная случка',
            ]
        ];
        DefaultNotify::insert($defaultReminders);
    }

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'max' => 'Длина поля :attribute не должна превышать :max символов.',
            'email' => 'Значение поля :attribute должно быть корректным email адресом.',
            'email.unique' => 'Пользователь с таким email адресом уже существует.',
            'password.min' => 'Минимальная длина пароля - :min символов.',
            'password.confirmed' => 'Повторный пароль не соответствует первому.',
        ], [
            'name' => '"Имя"',
            'email' => '"E-mail адрес"',
            'password' => '"Пароль"',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
