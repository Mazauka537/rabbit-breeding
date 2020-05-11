<?php

namespace App\Http\Controllers\Application;

use App\Cage;
use App\CageGroup;
use App\Http\Requests\Application\CageAddRequest;
use App\Http\Requests\Application\CageGroupAddRequest;
use App\Http\Requests\Application\CagesGetRequest;
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

    function getCages(CagesGetRequest $request)
    {
        $perPage = Auth::user()->pagination;
        $pageCount = ceil(Auth::user()->cages()->count() / $perPage);

        if (!$request->has('page')) $request->page = 1;
        if (!$request->has('sortby')) $request->sortby = 'created_at';
        $sortby = $request->sortby;

        $cageGroups = Auth::user()->cageGroups()->with('cages.rabbits')->with('rabbits')->get();

        $cages = Auth::user()->cages()
            ->where('cage_group_id', null)
            ->with('rabbits')
            ->orderByDesc($sortby)
            ->offset($perPage * abs($request->page - 1))
            ->limit($perPage)
            ->get();

        $theme = $this->getThemePath();


        return view('application.cages', compact(['cages', 'theme', 'pageCount', 'sortby', 'cageGroups']));
    }

    function addCage(CageAddRequest $request)
    {
        $cage = new Cage();

        $cage->name = $request->name;
        $cage->desc = $request->desc;
        $cage->user_id = Auth::id();
        $cage->cage_group_id = $request->group ?? null;

        $cage->save();

        session()->flash('message', ['Новая клетка успешно добавлена.']);

        return redirect(route('cages'));
    }

    function addCageGroup(CageGroupAddRequest $request)
    {
        $cageGroup = new CageGroup();

        $cageGroup->name = $request->name;
        $cageGroup->desc = $request->desc;
        $cageGroup->user_id = Auth::id();

        $cageGroup->save();

        session()->flash('message', ['Новая группа клеток успешно добавлена.']);

        return back();
    }

    function editCage(CageAddRequest $request, $id)
    {
        $cage = Auth::user()->cages()->findOrFail($id);

        $cage->name = $request->name;
        $cage->desc = $request->desc;
        $cage->cage_group_id = $request->group ?? null;

        $cage->save();

        session()->flash('message', ['Клетка успешно изменена.']);

        return back();
    }

    function editCageGroup(CageGroupAddRequest $request, $id)
    {
        $cageGroup = Auth::user()->cageGroups()->findOrFail($id);

        $cageGroup->name = $request->name;
        $cageGroup->desc = $request->desc;

        $cageGroup->save();

        session()->flash('message', ['Группа клеток успешно изменена.']);

        return back();
    }

    function deleteCage($id)
    {
        $cage = Auth::user()->cages()->findOrFail($id);

        $cage->rabbits()->update(['cage_id' => null]);

        $cage->delete();

        session()->flash('message', ['Клетка "' . $cage->name . '" успешно удалена.']);

        return back();
    }

    function deleteCageGroup($id)
    {
        $cageGroup = Auth::user()->cageGroups()->findOrFail($id);

        $cageGroup->rabbits()->update(['cage_id' => null]);

        $cageGroup->delete();

        session()->flash('message', ['Группа клеток "' . $cageGroup->name . '" успешно удалена.']);

        return back();
    }
}
