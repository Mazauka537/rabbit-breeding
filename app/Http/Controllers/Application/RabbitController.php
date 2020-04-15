<?php

namespace App\Http\Controllers\Application;

use App\Rabbit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RabbitController extends Controller
{
    private function findNameById($arr, $id)
    {
        $item_name = "";
        foreach ($arr as $item) {
            if ($id == $item->id) {
                $item_name = $item->name;
                break;
            }
        }
        if ($item_name == "")
            return false;
        else
            return $item_name;
    }

    private function getRandomStr($length) {
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
            $rabbit->cage_name = ($cage_name = $this->findNameById($cages, $rabbit->cage_id)) ? $cage_name : null;
            $rabbit->breed_name = ($breed_name = $this->findNameById($breeds, $rabbit->breed_id)) ? $breed_name : null;
        }
        return view('application.rabbits', ['rabbits' => $rabbits, 'cages' => $cages, 'breeds' => $breeds]);
    }

    function getRabbit($id)
    {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        return view('application.rabbit', ['rabbit' => $rabbit]);
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
            'mother' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id(),
            'father' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id(),
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
            $path = $request->file('photo')->store('\application\images\\' . Auth::id() . '\rabbits', 'public');

            if (!$path) {
                return response('', 422);
            }

            $rabbit->photo = $path;
        }

        $rabbit->save();

        return redirect(route('rabbits'));
    }
}
