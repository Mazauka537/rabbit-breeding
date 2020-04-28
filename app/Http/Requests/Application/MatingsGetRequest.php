<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MatingsGetRequest extends FormRequest
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

    protected $redirectRoute = 'matings';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $perPage = Auth::user()->pagination;

        $pageCount = ceil(Auth::user()->matings()->count() / $perPage);

        return [
            'page' => 'nullable|integer|min:1|max:' . $pageCount,
            'sortby' => 'nullable|string|in:date,date_birth,female_name,male_name,child_count,alive_count,desc',
        ];
    }

    public function messages()
    {
        return [
            'integer' => 'Значение параметра :attribute должно быть числом',
            'min' => 'Минимальная страница - :min',
            'max' => 'Максимальная страница - :max',
            'in' => 'Неизвестный параметр сортировки',
        ];
    }
}
