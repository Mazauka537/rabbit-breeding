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

    private function getRandomStr($length)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = substr(str_shuffle(str_shuffle(str_shuffle($permitted_chars))), 0, $length);
        return $str;
    }

    function getRabbits()
    {
        $cages = Auth::user()->cages;
        $breeds = Auth::user()->breeds;
        $rabbits = Auth::user()->rabbits;
        foreach ($rabbits as $rabbit) {
            $rabbit->cage_name = ($cage = $this->findItemById($cages, $rabbit->cage_id)) ? $cage->name : null;
            $rabbit->breed_name = ($breed = $this->findItemById($breeds, $rabbit->breed_id)) ? $breed->name : null;
        }
        return view('application.rabbits', ['rabbits' => $rabbits, 'cages' => $cages, 'breeds' => $breeds]);
    }

    function getRabbit($id)
    {
        $cages = Auth::user()->cages;
        $breeds = Auth::user()->breeds;
        $rabbits = Auth::user()->rabbits;

        $rabbit = ($r = $this->findItemById($rabbits, $id)) ? $r : null;
        if ($rabbit == null || $rabbit->user_id != Auth::id())
            return response(view('errors.404'), 404);

        $rabbit->breed_name = ($breed = $this->findItemById($breeds, $rabbit->breed_id)) ? $breed->name : '(нет)';
        $rabbit->cage_name = ($cage = $this->findItemById($cages, $rabbit->cage_id)) ? $cage->name : '(нет)';
        $rabbit->mother_name = ($mother = $this->findItemById($rabbits, $rabbit->mother_id)) ? $mother->name : '(нет)';
        $rabbit->father_name = ($father = $this->findItemById($rabbits, $rabbit->father_id)) ? $father->name : '(нет)';

        return view('application.rabbit', compact(['rabbit', 'rabbits', 'cages', 'breeds']));
    }

    function addRabbit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'gender' => 'required|in:f,m',
            'photo' => 'nullable|image',
            'breed' => 'nullable|integer|exists:breeds,id,user_id,' . Auth::id(),
            'cage' => 'nullable|integer|exists:cages,id,user_id,' . Auth::id(),
            'birthday' => 'nullable|date',
            'desc' => 'nullable|string|max:255',
            'mother' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,f',
            'father' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,m',
        ]);

        $rabbit = new Rabbit();

        $rabbit->name = $request->name;
        $rabbit->gender = $request->gender;
        $rabbit->breed_id = $request->breed;
        $rabbit->cage_id = $request->cage;
        $rabbit->user_id = Auth::id();
        $rabbit->birthday = $request->birthday;
        $rabbit->desc = $request->desc;
        $rabbit->mother_id = $request->mother;
        $rabbit->father_id = $request->father;

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

    function editRabbit(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'gender' => 'required|in:f,m',
            'photo' => 'nullable|image',
            'breed' => 'nullable|integer|exists:breeds,id,user_id,' . Auth::id(),
            'cage' => 'nullable|integer|exists:cages,id,user_id,' . Auth::id(),
            'birthday' => 'nullable|date',
            'desc' => 'nullable|string|max:255',
            'mother' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,f',
            'father' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,m',
        ]);

        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        $rabbit->name = $request->name;
        $rabbit->gender = $request->gender;
        $rabbit->breed_id = $request->breed;
        $rabbit->cage_id = $request->cage;
        $rabbit->birthday = $request->birthday;
        $rabbit->desc = $request->desc;
        $rabbit->mother_id = $request->mother;
        $rabbit->father_id = $request->father;

        $result = $rabbit->save();

        return back();
    }

    function deleteRabbit($id) {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);
        $rabbit->delete();
        return redirect(route('rabbits'));
    }

    function editPhoto(Request $request, $id) {

        $this->validate($request, [
            'photo' => 'nullable|image',
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
}
