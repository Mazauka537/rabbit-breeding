<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReminderAddRequest extends FormRequest
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
            'date' => 'required|date',
            'text' => 'required|string|max:255',
            'rabbit' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id(),
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'max' => 'Длина поля :attribute не должна превышать :max символа',
            'rabbit.integer' => 'В поле :attribute выбрано не существующее значение',
            'exists' => 'В поле :attribute выбрано не существующее значение',
            'date' => 'Значение поля :attribute должно быть датой',
        ];
    }

    public function attributes()
    {
        return [
            'date' => '"Дата"',
            'text' => '"Текст"',
            'rabbit' => '"Кролик"',
        ];
    }
}
