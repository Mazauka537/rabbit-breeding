<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\Application\VaccinationAddRequest;
use App\Http\Requests\Application\VaccinationGetRequest;
use App\Vaccination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    function getVaccinations(VaccinationGetRequest $request)
    {
        $perPage = Auth::user()->pagination;
        $pageCount = ceil(Auth::user()->vaccinations()->count() / $perPage);
        if ($pageCount == 0) $pageCount = 1;

        if (!$request->has('page')) $request->page = 1;
        if ($request->page > $pageCount) return back()->withErrors(['Страница ' . $request->page . ' не найдена.']);
        if (!$request->has('sortby')) $request->sortby = 'date';
        $sortby = $request->sortby;

        $sortbyA = 'vaccinations.' . $sortby;
        if ($sortby == 'rabbit_name')
            $sortbyA = 'rabbit_name';

        $vaccinations = Auth::user()->vaccinations()
            ->leftJoin('rabbits', 'vaccinations.rabbit_id', '=', 'rabbits.id')
            ->select('vaccinations.*', 'rabbits.name as rabbit_name', 'rabbits.gender as rabbit_gender')
            ->orderBy(DB::raw('ISNULL(' . $sortbyA . '), ' . $sortbyA), 'ASC')
            ->offset($perPage * abs($request->page - 1))
            ->limit($perPage)
            ->get();
        $rabbits = Auth::user()->rabbits;
        $theme = $this->getThemePath();

        $pagination = [];
        $pagination['pageCount'] = $pageCount;
        $pagination['currentPage'] = $request->page;
        $pagination['route'] = route('vaccinations');
        $pagination['arguments'] = '&sortby=' . $sortby;
        $pagination['size'] = config('app.pagination_size');

        return view('application.vaccinations', compact(['vaccinations', 'rabbits', 'theme', 'pagination', 'sortby']));
    }

    function addVaccination(VaccinationAddRequest $request)
    {
        if (!empty($request->date)) {
            $rabbit = Auth::user()->rabbits()->findOrFail($request->rabbit);
            if (strtotime($rabbit->birthday) > strtotime($request->date)) {
                $request->flash();
                return back()->withErrors(['Дата вакцинации не может быть раньше даты рождения кролика.']);
            }
        }

        $vaccination = new Vaccination();

        $vaccination->user_id = Auth::id();
        $vaccination->name = $request->name;
        $vaccination->rabbit_id = $request->rabbit;
        $vaccination->date = $request->date;
        $vaccination->desc = $request->desc;

        $vaccination->save();

        session()->flash('message', ['Новая вакцинация успешно добавлена.']);

        return back();
    }

    function editVaccination(VaccinationAddRequest $request, $id)
    {
        if (!empty($request->date)) {
            $rabbit = Auth::user()->rabbits()->findOrFail($request->rabbit);
            if (strtotime($rabbit->birthday) > strtotime($request->date)) {
                return back()->withErrors(['Дата вакцинации не может быть раньше даты рождения кролика.']);
            }
        }

        $vaccination = Auth::user()->vaccinations()->findOrFail($id);

        $vaccination->name = $request->name;
        $vaccination->rabbit_id = $request->rabbit;
        $vaccination->date = $request->date;
        $vaccination->desc = $request->desc;

        $vaccination->save();

        session()->flash('message', ['Вакцинация успешно изменена.']);

        return back();
    }

    function deleteVaccination($id)
    {
        $vaccination = Auth::user()->vaccinations()->findOrFail($id);

        $vaccination->delete();

        session()->flash('message', ['Вакциная "' . $vaccination->name . '" успешно удалена.']);

        return back();
    }
}
