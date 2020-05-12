<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BreedAddRequest extends FormRequest
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
            'desc' => 'nullable|string|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения.',
            'max' => 'Длина поля :attribute не должна превышать :max символа.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '"Название"',
            'desc' => '"Описание"',
        ];
    }
}
