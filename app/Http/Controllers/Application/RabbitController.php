<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\Application\RabbitAddRequest;
use App\Http\Requests\Application\RabbitEditPhotoRequest;
use App\Http\Requests\Application\RabbitsGetRequest;
use App\Rabbit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RabbitController extends Controller
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

    private function findItemById($arr, $id)
    {
        $result = false;
        foreach ($arr as $item) {
            if ($id == $item->id) {
                $result = $item;
                break;
            }
        }

        return $result;
    }

//    private function getUniqueItems($array, $field)
//    {
//        $result = [];
//        foreach ($array as $item) {
//            if (!in_array($item[$field], $result)) {
//                $result[] = $item[$field];
//            }
//        }
//
//        if (count($result) != 0)
//            return $result;
//        else
//            return false;
//    }

    private function getRandomStr($length)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = substr(str_shuffle(str_shuffle(str_shuffle($permitted_chars))), 0, $length);
        return $str;
    }

    private function setRabbitStatus($status)
    {
        switch ($status) {
            case 'young':
                return 'Молодняк';
            case 'ready':
                return 'Готова к спариванию';
            case 'pregnant':
                return 'Беременная';
            case 'lactation':
                return 'Лактация';
            case 'rest':
                return 'Отдых';
        }
        return null;
    }

    function getYears($value) //YYYY-MM-DD
    {
        $date = explode('-', $value);
        if ($date[1] > date('m') || $date[1] == date('m') && $date[2] > date('d'))
            return (date('Y') - $date[0] - 1);
        else
            return (date('Y') - $date[0]);
    }

    function getDays($value) //YYYY-MM-DD
    {
        $now = time();
        $your_date = strtotime($value);
        $date_diff = $now - $your_date;
        return floor($date_diff / (60 * 60 * 24));
    }

    function getRabbits(RabbitsGetRequest $request)
    {
        $perPage = Auth::user()->pagination;
        $pageCount = ceil(Auth::user()->rabbits()->count() / $perPage);
        if ($pageCount == 0) $pageCount = 1;

        if (!$request->has('page')) $request->page = 1;
        if ($request->page > $pageCount) return back()->withErrors(['Страница ' . $request->page . ' не найдена.']);
        if (!$request->has('sortby')) $request->sortby = 'name';
        $sortby = $request->sortby;

        $sortbyA = 'rabbits.' . $sortby;
        if ($sortby == 'breed_name')
            $sortbyA = 'breed_name';
        if ($sortby == 'cage_name')
            $sortbyA = 'cage_name';

        $rabbits = Auth::user()->rabbits()
            ->leftJoin('cages', 'rabbits.cage_id', '=', 'cages.id')
            ->leftJoin('breeds', 'rabbits.breed_id', '=', 'breeds.id')
            ->select('rabbits.*', 'cages.name as cage_name', 'breeds.name as breed_name')
            ->orderBy(DB::raw('ISNULL('.$sortbyA.'), '.$sortbyA), 'ASC')
            ->offset($perPage * abs($request->page - 1))
            ->limit($perPage)
            ->get();

        $cages = Auth::user()->cages()->with('cageGroup')->orderByDesc('cage_group_id')->get();
        $breeds = Auth::user()->breeds;
        foreach ($rabbits as $rabbit) {
            $rabbit->status_value = $this->setRabbitStatus($rabbit->status);
        }
        $theme = $this->getThemePath();

        $pagination = [];
        $pagination['pageCount'] = $pageCount;
        $pagination['currentPage'] = $request->page;
        $pagination['route'] = route('rabbits');
        $pagination['arguments'] = '&sortby=' . $sortby;
        $pagination['size'] = config('app.pagination_size');

        return view('application.rabbits', compact(['rabbits', 'cages', 'breeds', 'theme', 'pagination', 'sortby']));
    }

    function getRabbit($id)
    {
        $cages = Auth::user()->cages()->with('cageGroup')->orderByDesc('cage_group_id')->get();
        $breeds = Auth::user()->breeds;
        $rabbits = Auth::user()->rabbits;

        $rabbit = ($r = $this->findItemById($rabbits, $id)) ? $r : null;
        if ($rabbit == null || $rabbit->user_id != Auth::id())
            return response('', 404);

        $matings = $rabbit->matings()
            ->leftJoin('rabbits as female_rabbits', 'matings.female_id', '=', 'female_rabbits.id')
            ->leftJoin('rabbits as male_rabbits', 'matings.male_id', '=', 'male_rabbits.id')
            ->select('matings.*', 'female_rabbits.name as female_name', 'male_rabbits.name as male_name')
            ->orderByDesc('date')
            ->get();

        $vaccinations = $rabbit->vaccinations()->orderByDesc('date')->get();

        $rabbit->breed = $this->findItemById($breeds, $rabbit->breed_id) ?? '(нет)';
        $rabbit->cage = $this->findItemById($cages, $rabbit->cage_id) ?? '(нет)';
        $rabbit->status_value = $this->setRabbitStatus($rabbit->status);
        $rabbit->matings_count = count($matings);
        if (!empty($rabbit->birthday)) {
            $rabbit->days = $this->getDays($rabbit->birthday);
            $rabbit->years = $this->getYears($rabbit->birthday);
            $rabbit->months = floor($rabbit->days / 30);
        }

        $child_count = 0;
        $alive_count = 0;
        foreach ($matings as $m) {
            $child_count += $m->child_count;
            $alive_count += $m->alive_count;
        }

        $rabbit->child_count = $child_count;
        $rabbit->alive_count = $alive_count;

        $theme = $this->getThemePath();

        return view('application.rabbit', compact(['rabbit', 'rabbits', 'cages', 'breeds', 'matings', 'vaccinations', 'theme']));
    }

    function addRabbit(RabbitAddRequest $request)
    {
        $rabbit = new Rabbit();

        $rabbit->name = $request->name;
        $rabbit->gender = $request->gender;
        if ($request->gender == 'f')
            $rabbit->status = $request->status;
        else
            $rabbit->status = null;
        $rabbit->breed_id = $request->breed;
        $rabbit->cage_id = $request->cage;
        $rabbit->user_id = Auth::id();
        $rabbit->birthday = $request->birthday;
        $rabbit->desc = $request->desc;

        if ($request->photo != null) {
            $path = $request->file('photo')->store('/application/images/' . Auth::id() . '/rabbits', 'public');

            if (!$path) {
                return response('', 422);
            }

            $rabbit->photo = $path;
        }

        $rabbit->save();

        session()->flash('message', ['Новый кролик успешно добавлен.']);

        return redirect(route('rabbits'));
    }

    function editRabbit(RabbitAddRequest $request, $id)
    {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        $rabbit->name = $request->name;
        $rabbit->gender = $request->gender;
        if ($request->gender == 'f')
            $rabbit->status = $request->status;
        else
            $rabbit->status = null;
        $rabbit->breed_id = $request->breed;
        $rabbit->cage_id = $request->cage;
        $rabbit->birthday = $request->birthday;
        $rabbit->desc = $request->desc;

        $result = $rabbit->save();

        session()->flash('message', ['Кролик успешно изменен.']);

        return back();
    }

    function deleteRabbit($id)
    {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        $rabbit->vaccinations()->delete();

        if (!empty($rabbit->photo)) {
            Storage::disk('public')->delete($rabbit->photo);
        }

        $rabbit->delete();

        session()->flash('message', ['Кролик "' . $rabbit->name . '" успешно удален.']);

        return redirect(route('rabbits'));
    }

    function editPhoto(RabbitEditPhotoRequest $request, $id)
    {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        if ($rabbit->photo != null) {
            Storage::disk('public')->delete($rabbit->photo);
        }

        if ($request->photo != null) {
            $path = $request->file('photo')->store('/application/images/' . Auth::id() . '/rabbits', 'public');

            if (!$path) {
                return response('', 422);
            }

            $rabbit->photo = $path;
        }

        $rabbit->save();

        session()->flash('message', ['Фото успешно изменено.']);

        return back();
    }

    function deletePhoto($id)
    {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        Storage::disk('public')->delete($rabbit->photo);

        $rabbit->photo = null;
        $rabbit->save();

        session()->flash('message', ['Фото успешно удалено.']);

        return back();
    }
}
