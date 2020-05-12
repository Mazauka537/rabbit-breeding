<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VaccinationGetRequest extends FormRequest
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

    protected $redirectRoute = 'vaccinations';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'page' => 'nullable|integer|min:1',
            'sortby' => 'nullable|string|in:date,name,desc,rabbit_name',
        ];
    }

    public function messages()
    {
        return [
            'integer' => 'Значение параметра :attribute должно быть числом',
            'min' => 'Минимальная страница - :min',
            'in' => 'Неизвестный параметр сортировки',
        ];
    }
}
