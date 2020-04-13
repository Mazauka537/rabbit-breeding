<?php

namespace App\Http\Controllers\Application;

use App\Rabbit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RabbitController extends Controller
{
    function getRabbits() {
        return view('application.rabbits');
    }

    function getRabbit() {
        return view('application.rabbit');
    }

    function addRabbit(Request $request) {
        $rabbit = new Rabbit();

        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'breed' => 'numeric',
            'cage' => 'numeric',
            'birthday' => 'date',
            'desc' => 'string|max:255',
            'mother' => 'numeric',
            'father' => 'numeric'
        ]);

        $rabbit->name = $request->name;
        return view('home');
    }
}
