<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\Application\DefaultMatingNotifyAddRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'name' => 'required|string|max:64',
            'pagination' => 'required|integer|min:1|max:90',
            'theme' => 'required|string|in:default,' . $themeList,
            'days_for_delete_reminders' => 'required_if:auto_delete_reminders,on|integer|min:1|max:30000',
        ], [
            'theme.required' => 'Выбрана несуществующая тема.',
            'required' => 'Поле :attribute обязательно для заполнения.',
            'integer' => 'Значение поля :attribute должно быть числом.',
            'name.max' => 'Длина поля :attribute не должна превышать :max символов.',
            'pagination.max' => 'Максимальное значение поля :attribute - :max.',
            'min' => 'Минимальное значение поля :attribute - :min.',
            'theme.in' => 'Выпрана несуществующая тема.',
            'required_if' => 'Поле :attribute обязательно для заполнения.',
            'max' => 'Максимальное значение поля :attribute - :max',
        ], [
            'name' => '"Ваше имя"',
            'pagination' => '"Записей на странице"',
            'theme' => '"Тема"',
            'days_for_delete_reminders' => '"Удалять через (дней)"',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->pagination = $request->pagination;
        $user->theme = $request->theme;
        $user->auto_mating_reminders = $request->auto_mating_reminders ? true : false;
        $user->days_for_delete_reminders = $request->days_for_delete_reminders ?? 0;
        $user->delete_only_checked_reminders = $request->delete_only_checked_reminders ? true : false;

        $user->save();

        session()->flash('message', ['Настройки сохранены.']);

        return back();
    }

    public function deleteUser() {
        $user = Auth::user();
        Storage::disk('public')->deleteDirectory('application/images/' . $user->id);
        Auth::logout();
        $user->delete();
        return redirect(route('login'));
    }
}
