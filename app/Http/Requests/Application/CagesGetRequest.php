<?php

namespace App\Http\Requests\Application;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CagesGetRequest extends FormRequest
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

    protected $redirectRoute = 'cages';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $perPage = Auth::user()->pagination;

        $cageCount = Auth::user()->cages()->where('cage_group_id', null)->count();
        $cageGroupCount = Auth::user()->cageGroups()->count();

        $pageCount = ceil(($cageCount + $cageGroupCount) / $perPage);

        return [
            'page' => 'nullable|integer|min:1|max:' . $pageCount,
            'sortby' => 'nullable|string|in:created_at,name,desc',
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
