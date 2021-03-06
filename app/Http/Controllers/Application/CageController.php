<?php

namespace App\Http\Controllers\Application;

use App\Cage;
use App\CageGroup;
use App\Http\Requests\Application\CageAddRequest;
use App\Http\Requests\Application\CageGroupAddRequest;
use App\Http\Requests\Application\CagesGetRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $cageCount = Auth::user()->cages()->where('cage_group_id', null)->count();
        $cageGroupCount = Auth::user()->cageGroups()->count();

        $pageCount = ceil(($cageCount + $cageGroupCount) / $perPage);
        if ($pageCount == 0) $pageCount = 1;

        if (!$request->has('page')) $request->page = 1;
        if ($request->page > $pageCount) return back()->withErrors(['Страница ' . $request->page . ' не найдена.']);
        if (!$request->has('sortby')) $request->sortby = 'name';
        $sortby = $request->sortby;

        $sortbyA = 'cage_groups.' . $sortby;

        $cageGroupsAll = Auth::user()->cageGroups()
            ->with('cages.rabbits')
            ->with('rabbits')
            ->orderBy(DB::raw('ISNULL(' . $sortbyA . '), ' . $sortbyA), 'ASC')
            ->get();

        $cageGroups = new Collection();
        for ($i = $perPage * abs($request->page - 1); $i < $perPage * abs($request->page - 1) + $perPage; $i++) {
            if ($i < count($cageGroupsAll))
                $cageGroups[] = $cageGroupsAll[$i];
            else
                break;
        }

        $cages = new Collection();

        if (count($cageGroups) < $perPage) {
            $sortbyA = 'cages.' . $sortby;

            $cages = Auth::user()->cages()
                ->where('cage_group_id', null)
                ->with('rabbits')
                ->orderBy(DB::raw('ISNULL(' . $sortbyA . '), ' . $sortbyA), 'ASC')
                ->offset((abs($request->page - 1) * $perPage) - $cageGroupCount)
                ->limit($perPage - count($cageGroups))
                ->get();
        }

        $theme = $this->getThemePath();

        $pagination = [];
        $pagination['pageCount'] = $pageCount;
        $pagination['currentPage'] = $request->page;
        $pagination['route'] = route('cages');
        $pagination['arguments'] = '&sortby=' . $sortby;
        $pagination['size'] = config('app.pagination_size');

        return view('application.cages', compact(['cages', 'theme', 'pagination', 'sortby', 'cageGroups', 'cageGroupsAll']));
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

        return back();
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

        $cage->delete();

        session()->flash('message', ['Клетка "' . $cage->name . '" успешно удалена.']);

        return back();
    }

    function deleteCageGroup($id)
    {
        $cageGroup = Auth::user()->cageGroups()->findOrFail($id);

        $cageGroup->delete();

        session()->flash('message', ['Группа клеток "' . $cageGroup->name . '" успешно удалена.']);

        return back();
    }
}
