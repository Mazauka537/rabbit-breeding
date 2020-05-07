<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DefaultMatingNotifyAddRequest extends FormRequest
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
            'days' => 'required|integer|min:0',
            'text' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'max' => 'Длина поля :attribute не должна превышать :max символа.',
            'min' => 'Минимальное значение поля :attribute - :min символов.',
            'date' => 'Значение поля :attribute должно быть датой.',
            'integer' => 'Значение поля :attribute должно быть числом',
        ];
    }

    public function attributes()
    {
        return [
            'days' => '"Дни"',
            'text' => '"Текст"',
        ];
    }
}
