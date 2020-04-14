<?php

namespace App\Http\Controllers\Application;

use App\Cage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CageController extends Controller
{
    function getCages() {
        $cages = Auth::user()->cages;
        return view('application.cages', ['cages' => $cages]);
    }

    function getCage() {
        return view('application.cage');
    }

    function addCage(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'desc' => 'max:255'
        ]);

        $cage = new Cage();

        $cage->name = $request->name;
        $cage->desc = $request->desc;
        $cage->user_id = Auth::id();

        $cage->save();

        return redirect(route('cages'));
    }
}
