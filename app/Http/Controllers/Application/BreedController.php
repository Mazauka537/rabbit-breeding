<?php

namespace App\Http\Controllers\Application;

use App\Breed;
use App\Http\Requests\Application\BreedAddRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BreedController extends Controller
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

    function getBreeds()
    {
        $breeds = Auth::user()->breeds()->with('rabbits')->get();

        $theme = $this->getThemePath();

        return view('application.breeds', compact(['breeds', 'theme']));
    }

    function addBreed(BreedAddRequest $request)
    {
        $breed = new Breed();

        $breed->name = $request->name;
        $breed->desc = $request->desc;
        $breed->user_id = Auth::id();

        $breed->save();

        return redirect(route('breeds'));
    }

    function editBreed(BreedAddRequest $request, $id)
    {
        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->name = $request->name;
        $breed->desc = $request->desc;

        $breed->save();

        return redirect(route('breeds'));
    }

    function deleteBreed($id)
    {
        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->rabbits()->update(['breed_id' => null]);

        $breed->delete();

        return redirect(route('breeds'));
    }
}
