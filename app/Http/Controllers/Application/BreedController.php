<?php

namespace App\Http\Controllers\Application;

use App\Breed;
use App\Http\Requests\Application\BreedAddRequest;
use App\Http\Requests\Application\BreedsGetRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if ($pageCount == 0) $pageCount = 1;

        if (!$request->has('page')) $request->page = 1;
        if ($request->page > $pageCount) return back()->withErrors(['Страница ' . $request->page . ' не найдена.']);
        if (!$request->has('sortby')) $request->sortby = 'name';
        $sortby = $request->sortby;

        $sortbyA = 'breeds.' . $sortby;

        $breeds = Auth::user()->breeds()
            ->with('rabbits')
            ->orderBy(DB::raw('ISNULL(' . $sortbyA . '), ' . $sortbyA), 'ASC')
            ->offset($perPage * abs($request->page - 1))
            ->limit($perPage)
            ->get();

        $theme = $this->getThemePath();

        $pagination = [];
        $pagination['pageCount'] = $pageCount;
        $pagination['currentPage'] = $request->page;
        $pagination['route'] = route('breeds');
        $pagination['arguments'] = '&sortby=' . $sortby;
        $pagination['size'] = config('app.pagination_size');

        return view('application.breeds', compact(['breeds', 'theme', 'pagination', 'sortby']));
    }

    function addBreed(BreedAddRequest $request)
    {
        $breed = new Breed();

        $breed->name = $request->name;
        $breed->desc = $request->desc;
        $breed->user_id = Auth::id();

        $breed->save();

        session()->flash('message', ['Новая порода успешно добавлена.']);

        return back();
    }

    function editBreed(BreedAddRequest $request, $id)
    {
        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->name = $request->name;
        $breed->desc = $request->desc;

        $breed->save();

        session()->flash('message', ['Порода успешно изменена.']);

        return back();
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
