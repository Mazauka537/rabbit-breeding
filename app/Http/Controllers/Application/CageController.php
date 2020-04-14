<?php

namespace App\Http\Controllers\Application;

use App\Cage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CageController extends Controller
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

    function getCages() {
        $cages = Auth::user()->cages;
        $rabbits = Auth::user()->rabbits;
        foreach ($cages as $cage) {
            $cage->rabbits = $this->getItemsWithParam($rabbits, 'breed_id', $cage->id);
        }

        return view('application.cages', ['cages' => $cages]);
    }

    function getCage() {
        return view('application.cage');
    }

    function addCage(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:64',
            'desc' => 'nullable|string|max:255'
        ]);

        $cage = new Cage();

        $cage->name = $request->name;
        $cage->desc = $request->desc;
        $cage->user_id = Auth::id();

        $cage->save();

        return redirect(route('cages'));
    }
}
