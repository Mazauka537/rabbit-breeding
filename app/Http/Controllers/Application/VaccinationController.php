<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\Application\VaccinationAddRequest;
use App\Vaccination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
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

    function getVaccinations()
    {
        $vaccinations = Auth::user()->vaccinations()->with('rabbit')->get();
        $rabbits = Auth::user()->rabbits;
        $theme = $this->getThemePath();

        return view('application.vaccinations', compact(['vaccinations', 'rabbits', 'theme']));
    }

    function addVaccination(VaccinationAddRequest $request)
    {
        $vaccination = new Vaccination();

        $vaccination->user_id = Auth::id();
        $vaccination->name = $request->name;
        $vaccination->rabbit_id = $request->rabbit;
        $vaccination->date = $request->date;
        $vaccination->desc = $request->desc;

        $vaccination->save();

        return back();
    }

    function editVaccination(VaccinationAddRequest $request, $id)
    {

        $vaccination = Auth::user()->vaccinations()->findOrFail($id);

        $vaccination->name = $request->name;
        $vaccination->rabbit_id = $request->rabbit;
        $vaccination->date = $request->date;
        $vaccination->desc = $request->desc;

        $vaccination->save();

        return back();
    }

    function deleteVaccination($id)
    {
        $vaccination = Auth::user()->vaccinations()->findOrFail($id);

        $vaccination->delete();

        return back();
    }
}
