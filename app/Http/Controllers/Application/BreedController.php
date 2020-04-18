<?php

namespace App\Http\Controllers\Application;

use App\Breed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BreedController extends Controller
{
    private function getItemsWithParam($array, $param, $value) {
        $result = [];
        foreach ($array as $item) {
            if ($item[$param] == $value) {
                $result[] = $item;
            }
        }
        return $result;
    }

    function getBreeds() {
        $breeds = Auth::user()->breeds;
        $rabbits = Auth::user()->rabbits;
        foreach ($breeds as $breed) {
            $breed->rabbits = $this->getItemsWithParam($rabbits, 'breed_id', $breed->id);
        }
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
}
