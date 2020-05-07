<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\Application\DefaultMatingNotifyAddRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    private function getThemePath() {
        $theme = Auth::user()->theme;
        if (!empty($theme)) {
            $themes = json_decode(file_get_contents('application/themes.json'));

            foreach ($themes as $key => $value) {
                if ($key == $theme) {
                    $theme = $value->path;
                    break;
                }
            }
        }

        return $theme;
    }

    public function getSettings() {
        $user = Auth::user();
        $theme = $this->getThemePath();
        $themes = json_decode(file_get_contents('application/themes.json'));
        $defaultNotifies = $user->defaultNotifies()->orderBy('days')->get();

        return view('application.settings', compact(['user', 'theme', 'themes', 'defaultNotifies']));
    }

    public function saveSettings(Request $request) {
        $themes = json_decode(file_get_contents('application/themes.json'));

        $themeList = [];
        foreach ($themes as $key => $value) {
            $themeList[] = $key;
        }

        $themeList = implode(',', $themeList);

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'pagination' => 'required|integer|min:1|max:200',
            'theme' => 'required|string|in:default,' . $themeList,
        ], [
            'theme.required' => 'Выпрана несуществующая тема.',
            'required' => 'Поле :attribute обязательно для заполнения.',
            'integer' => 'Значение поля :attribute должно быть числом.',
            'name.max' => 'Длина поля :attribute не должна превышать :max символов.',
            'pagination.max' => 'Максимальное значение поля :attribute - :min.',
            'min' => 'Минимальное значение поля :attribute - :min.',
            'theme.in' => 'Выпрана несуществующая тема.',
        ], [
            'name' => '"Ваше имя"',
            'pagination' => '"Записей на странице"',
            'theme' => '"Тема"',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->pagination = $request->pagination;
        $user->theme = $request->theme;
        $user->auto_mating_reminders = $request->auto_mating_reminders ? true : false;

        $user->save();

        session()->flash('message', ['Настройки сохранены.']);

        return back();
    }
}
