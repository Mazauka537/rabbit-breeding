<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RabbitAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:64',
            'gender' => 'required|in:f,m',
            'status' => 'required_if:gender,f|in:young,ready,pregnant,lactation,rest',
            'photo' => 'nullable|image',
            'breed' => 'nullable|integer|exists:breeds,id,user_id,' . Auth::id(),
            'cage' => 'nullable|integer|exists:cages,id,user_id,' . Auth::id(),
            'birthday' => 'nullable|date',
            'desc' => 'nullable|string|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'max' => 'Длина поля :attribute не должна превышать :max символа.',
            'in' => 'Недопустимое значение поля :attribute.',
            'required_if' => 'Поле :attribute обязательно для заполнения.',
            'image' => ':attribute должно иметь формат png, jpeg или gif.',
            'breed.integer' => 'В поле :attribute выбрано не существующее значение.',
            'cage.integer' => 'В поле :attribute выбрано не существующее значение.',
            'exists' => 'В поле :attribute выбрано не существующее значение.',
            'date' => 'Значение поля :attribute должно быть датой.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '"Имя"',
            'gender' => '"Пол"',
            'status' => '"Статус"',
            'photo' => '"Фото"',
            'breed' => '"Порода"',
            'cage' => '"Клетка"',
            'birthday' => '"Дата рождения"',
            'desc' => '"Описание"',
        ];
    }
}
