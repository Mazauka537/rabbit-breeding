<?php

namespace App\Http\Controllers\Application;

use App\Vaccination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{
    function getVaccinations()
    {
        $vaccinations = Auth::user()->vaccinations()->with('rabbit')->get();
        $rabbits = Auth::user()->rabbits;

        return view('application.vaccinations', compact('vaccinations', 'rabbits'));
    }

    function addVaccination(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'rabbit' => 'required|integer|exists:rabbits,id,user_id,' . Auth::id(),
            'date' => 'nullable|date',
            'desc' => 'nullable|string|max:255',
        ]);

        $vaccination = new Vaccination();

        $vaccination->user_id = Auth::id();
        $vaccination->name = $request->name;
        $vaccination->rabbit_id = $request->rabbit;
        $vaccination->date = $request->date;
        $vaccination->desc = $request->desc;

        $vaccination->save();

        return back();
    }
}
