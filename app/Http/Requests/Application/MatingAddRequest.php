<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MatingAddRequest extends FormRequest
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
            'female' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,f',
            'male' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,m',
            'date' => 'nullable|date',
            'birth_date' => 'nullable|date',
            'child_count' => 'nullable|integer|min:0',
            'alive_count' => 'nullable|integer|min:0',
            'desc' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'max' => 'Длина поля :attribute не должна превышать :max символа.',
            'female.integer' => 'В поле :attribute выбрано не существующее значение.',
            'male.integer' => 'В поле :attribute выбрано не существующее значение.',
            'exists' => 'В поле :attribute выбрано не существующее значение.',
            'date' => 'Значение поля :attribute должно быть датой.',
            'integer' => 'Значение поля :attribute должно быть числом.',
            'min' => 'Значение поля :attribute не может быть отрицательным',
        ];
    }

    public function attributes()
    {
        return [
            'female' => '"Самка"',
            'male' => '"Самец"',
            'date' => '"Дата случки"',
            'birth_date' => '"Дата окрола"',
            'child_count' => '"Рождено"',
            'alive_count' => '"Выжило"',
            'desc' => '"Примечания"',
        ];
    }
}
