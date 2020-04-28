<?php

namespace App\Http\Controllers\Application;

use App\Breed;
use App\Http\Requests\Application\BreedAddRequest;
use App\Http\Requests\Application\BreedsGetRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

    function getBreeds(BreedsGetRequest $request)
    {
        $perPage = Auth::user()->pagination;
        $pageCount = ceil(Auth::user()->breeds()->count() / $perPage);

        if (!$request->has('page')) $request->page = 1;
        if (!$request->has('sortby')) $request->sortby = 'created_at';
        $sortby = $request->sortby;

        $breeds = Auth::user()->breeds()
            ->with('rabbits')
            ->orderByDesc($sortby)
            ->offset($perPage * abs($request->page - 1))
            ->limit($perPage)
            ->get();

        $theme = $this->getThemePath();

        return view('application.breeds', compact(['breeds', 'theme', 'pageCount', 'sortby']));
    }

    function addBreed(BreedAddRequest $request)
    {
        $breed = new Breed();

        $breed->name = $request->name;
        $breed->desc = $request->desc;
        $breed->user_id = Auth::id();

        $breed->save();

        session()->flash('message', ['Новая порода успешно добавлена.']);

        return redirect(route('breeds'));
    }

    function editBreed(BreedAddRequest $request, $id)
    {
        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->name = $request->name;
        $breed->desc = $request->desc;

        $breed->save();

        session()->flash('message', ['Порода "' . $breed->name . '" успешно изменена.']);

        return redirect(route('breeds'));
    }

    function deleteBreed($id)
    {
        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->rabbits()->update(['breed_id' => null]);

        $breed->delete();

        session()->flash('message', ['Порода "' . $breed->name . '" успешно удалена.']);

        return redirect(route('breeds'));
    }
}
