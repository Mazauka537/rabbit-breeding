<?php

namespace App\Http\Controllers\Application;

use App\Rabbit;
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

    function getRabbit() {
        return view('application.rabbit');
    }

    function addRabbit(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'breed' => 'numeric',
            'cage' => 'numeric',
            'birthday' => 'date',
            'desc' => 'string|max:255',
            'mother' => 'integer',
            'father' => 'integer'
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
