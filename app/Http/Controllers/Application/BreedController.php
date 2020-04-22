<?php

namespace App\Http\Controllers\Application;

use App\Breed;
use App\Http\Requests\Application\BreedAddRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BreedController extends Controller
{
    function getBreeds()
    {
        $breeds = Auth::user()->breeds()->with('rabbits')->get();

        return view('application.breeds', ['breeds' => $breeds]);
    }

    function addBreed(BreedAddRequest $request)
    {
        $breed = new Breed();

        $breed->name = $request->name;
        $breed->desc = $request->desc;
        $breed->user_id = Auth::id();

        $breed->save();

        return redirect(route('breeds'));
    }

    function editBreed(BreedAddRequest $request, $id)
    {
        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->name = $request->name;
        $breed->desc = $request->desc;

        $breed->save();

        return redirect(route('breeds'));
    }

    function deleteBreed($id)
    {
        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->rabbits()->update(['breed_id' => null]);

        $breed->delete();

        return redirect(route('breeds'));
    }
}
