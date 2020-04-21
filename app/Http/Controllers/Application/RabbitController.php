<?php

namespace App\Http\Controllers\Application;

use App\Breed;
use App\Rabbit;
use App\Cage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RabbitController extends Controller
{
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

    private function getUniqueItems($array, $field)
    {
        $result = [];
        foreach ($array as $item) {
            if (!in_array($item[$field], $result)) {
                $result[] = $item[$field];
            }
        }

        if (count($result) != 0)
            return $result;
        else
            return false;
    }

    private function getRandomStr($length)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = substr(str_shuffle(str_shuffle(str_shuffle($permitted_chars))), 0, $length);
        return $str;
    }

    private function setRabbitStatus($status)
    {
        switch ($status) {
            case 'yong':
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

    function getRabbits()
    {
        $cages = Auth::user()->cages;
        $breeds = Auth::user()->breeds;
        $rabbits = Auth::user()->rabbits;
        foreach ($rabbits as $rabbit) {
            $rabbit->cage_name = ($cage = $this->findItemById($cages, $rabbit->cage_id)) ? $cage->name : null;
            $rabbit->breed_name = ($breed = $this->findItemById($breeds, $rabbit->breed_id)) ? $breed->name : null;
            $rabbit->status_value = $this->setRabbitStatus($rabbit->status);
        }
        return view('application.rabbits', compact(['rabbits', 'cages', 'breeds']));
    }

    function getRabbit($id)
    {
        $cages = Auth::user()->cages;
        $breeds = Auth::user()->breeds;
        $rabbits = Auth::user()->rabbits;
        $all_vaccinations = Auth::user()->vaccinations;

        $rabbit = ($r = $this->findItemById($rabbits, $id)) ? $r : null;
        if ($rabbit == null || $rabbit->user_id != Auth::id())
            return response(view('errors.404'), 404);

        $rabbit->breed = $this->findItemById($breeds, $rabbit->breed_id) ?? '(нет)';
        $rabbit->cage = $this->findItemById($cages, $rabbit->cage_id) ?? '(нет)';
        $rabbit->status_value = $this->setRabbitStatus($rabbit->status);

        $matings = $rabbit->matings;
        $vaccinations = $rabbit->vaccinations;

        $uniqueVaccinations = $this->getUniqueItems($all_vaccinations, 'name');

        return view('application.rabbit', compact(['rabbit', 'rabbits', 'cages', 'breeds', 'matings', 'vaccinations', 'uniqueVaccinations']));
    }

    function addRabbit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'gender' => 'required|in:f,m',
            'status' => 'required_if:gender,f|in:young,ready,pregnant,lactation,rest',
            'photo' => 'nullable|image',
            'breed' => 'nullable|integer|exists:breeds,id,user_id,' . Auth::id(),
            'cage' => 'nullable|integer|exists:cages,id,user_id,' . Auth::id(),
            'birthday' => 'nullable|date',
            'desc' => 'nullable|string|max:255',
        ]);

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

        return redirect(route('rabbits'));
    }

    function editRabbit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'gender' => 'required|in:f,m',
            'status' => 'required_if:gender,f|in:young,ready,pregnant,lactation,rest',
            'photo' => 'nullable|image',
            'breed' => 'nullable|integer|exists:breeds,id,user_id,' . Auth::id(),
            'cage' => 'nullable|integer|exists:cages,id,user_id,' . Auth::id(),
            'birthday' => 'nullable|date',
            'desc' => 'nullable|string|max:255',
        ]);

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

        return back();
    }

    function deleteRabbit($id)
    {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        if ($rabbit->gender == 'f')
            $rabbit->matings()->update(['female_id' => null]);
        else
            $rabbit->matings()->update(['male_id' => null]);

        $rabbit->vaccinations()->delete();

        $rabbit->delete();

        return redirect(route('rabbits'));
    }

    function editPhoto(Request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'required|image',
        ]);

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

        return back();
    }

    function deletePhoto($id)
    {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        Storage::disk('public')->delete($rabbit->photo);

        $rabbit->photo = null;
        $rabbit->save();

        return back();
    }
}
