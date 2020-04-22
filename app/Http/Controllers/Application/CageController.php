<?php

namespace App\Http\Controllers\Application;

use App\Cage;
use App\Http\Requests\Application\CageAddRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CageController extends Controller
{
    function getCages()
    {
        $cages = Auth::user()->cages()->with('rabbits')->get();

        return view('application.cages', ['cages' => $cages]);
    }

    function addCage(CageAddRequest $request)
    {
        $cage = new Cage();

        $cage->name = $request->name;
        $cage->desc = $request->desc;
        $cage->user_id = Auth::id();

        $cage->save();

        return redirect(route('cages'));
    }

    function editCage(CageAddRequest $request, $id)
    {
        $cage = Auth::user()->cages()->findOrFail($id);

        $cage->name = $request->name;
        $cage->desc = $request->desc;

        $cage->save();

        return redirect(route('cages'));
    }

    function deleteCage($id)
    {
        $cage = Auth::user()->cages()->findOrFail($id);

        $cage->rabbits()->update(['cage_id' => null]);

        $cage->delete();

        return redirect(route('cages'));
    }
}
