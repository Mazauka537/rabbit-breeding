<?php

namespace App\Http\Controllers\Application;

use App\Breed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BreedController extends Controller
{
    function getBreeds() {
        $breeds = Auth::user()->breeds;
        return view('application.breeds', ['breeds' => $breeds]);
    }

    function getBreed() {
        return view('application.breed');
    }

    function addBreed(Request $request) {

        $this->validate($request, [
            'name' => 'required|string|max:64',
            'desc' => 'max:255'
        ]);

        $breed = new Breed();

        $breed->name = $request->name;
        $breed->desc = $request->desc;
        $breed->user_id = Auth::id();

        $breed->save();

        return redirect(route('breeds'));
    }
}
