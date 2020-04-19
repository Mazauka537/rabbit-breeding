<?php

namespace App\Http\Controllers\Application;

use App\Breed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BreedController extends Controller
{
//    private function getItemsWithParam($array, $param, $value) {
//        $result = [];
//        foreach ($array as $item) {
//            if ($item[$param] == $value) {
//                $result[] = $item;
//            }
//        }
//        return $result;
//    }

    function getBreeds() {
        $breeds = Auth::user()->breeds()->with('rabbits')->get();

        return view('application.breeds', ['breeds' => $breeds]);
    }

    function addBreed(Request $request) {

        $this->validate($request, [
            'name' => 'required|string|max:64',
            'desc' => 'nullable|string|max:255'
        ]);

        $breed = new Breed();

        $breed->name = $request->name;
        $breed->desc = $request->desc;
        $breed->user_id = Auth::id();

        $breed->save();

        return redirect(route('breeds'));
    }

    function editBreed(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'desc' => 'nullable|string|max:255'
        ]);

        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->name = $request->name;
        $breed->desc = $request->desc;

        $breed->save();

        return redirect(route('breeds'));
    }

    function deleteBreed($id) {
        $breed = Auth::user()->breeds()->findOrFail($id);

        $breed->rabbits()->update(['breed_id' => null]);

        $breed->delete();

        return redirect(route('breeds'));
    }
}
