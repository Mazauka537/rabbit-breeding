<?php

namespace App\Http\Controllers\Application;

use App\Cage;
use App\Http\Requests\Application\CageAddRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CageController extends Controller
{
    private function getThemePath()
    {
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

    function getCages()
    {
        $cages = Auth::user()->cages()->with('rabbits')->get();

        $theme = $this->getThemePath();

        return view('application.cages', compact(['cages', 'theme']));
    }

    function addCage(CageAddRequest $request)
    {
        $cage = new Cage();

        $cage->name = $request->name;
        $cage->desc = $request->desc;
        $cage->user_id = Auth::id();

        $cage->save();

        return redirect(route('cages'));
    }

    function editCage(CageAddRequest $request, $id)
    {
        $cage = Auth::user()->cages()->findOrFail($id);

        $cage->name = $request->name;
        $cage->desc = $request->desc;

        $cage->save();

        return redirect(route('cages'));
    }

    function deleteCage($id)
    {
        $cage = Auth::user()->cages()->findOrFail($id);

        $cage->rabbits()->update(['cage_id' => null]);

        $cage->delete();

        return redirect(route('cages'));
    }
}
