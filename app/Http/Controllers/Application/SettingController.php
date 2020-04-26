<?php

namespace App\Http\Controllers\Application;

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

        return view('application.settings', compact(['user', 'theme', 'themes']));
    }

    public function saveSettings(Request $request) {
        $themes = json_decode(file_get_contents('application/themes.json'));

        $themeList = [];
        foreach ($themes as $key => $value) {
            $themeList[] = $key;
        }

        $themeList = implode(',', $themeList);

        $this->validate($request, [
            'pagination' => 'required|integer|min:1|max:200',
            'theme' => 'required|string|in:default,' . $themeList,
        ]);

        $user = Auth::user();

        $user->pagination = $request->pagination;
        $user->theme = $request->theme;

        $user->save();

        return back();
    }
}
