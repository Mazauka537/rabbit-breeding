<?php

namespace App\Http\Controllers\Application;

use App\Rabbit;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RabbitController extends Controller
{
    function getRabbits() {
        $cages = Auth::user()->cages;
        $breeds = Auth::user()->breeds;
        $rabbits = Auth::user()->rabbits;
        return view('application.rabbits', ['rabbits' => $rabbits, 'cages' => $cages, 'breeds' => $breeds]);
    }

    function getRabbit($id) {
        $rabbit = Auth::user()->rabbits()->findOrFail($id);

        return view('application.rabbit', ['rabbit' => $rabbit]);
    }

    function addRabbit(Request $request) {

        $this->validate($request, [
            'name' => 'required|string|max:64',
            'gender' => 'required|in:f,m',
            'breed' => 'nullable|integer|exists:breeds,id,user_id,'.Auth::id(),
            'cage' => 'nullable|integer|exists:cages,id,user_id,'.Auth::id(),
            'birthday' => 'nullable|date',
            'desc' => 'nullable|string|max:255',
            'mother' => 'nullable|integer|exists:rabbits,id,user_id,'.Auth::id(),
            'father' => 'nullable|integer|exists:rabbits,id,user_id,'.Auth::id(),
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

        $rabbit->save();

        return redirect(route('rabbits'));
    }
}
