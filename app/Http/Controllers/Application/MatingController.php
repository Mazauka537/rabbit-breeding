<?php

namespace App\Http\Controllers\Application;

use App\Mating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MatingController extends Controller
{
//    private function findItemById($arr, $id)
//    {
//        $result = false;
//        foreach ($arr as $item) {
//            if ($id == $item->id) {
//                $result = $item;
//                break;
//            }
//        }
//
//        return $result;
//    }

    function getMatings()
    {
        $matings = Auth::user()->matings()->with(['female', 'male'])->get();

        $rabbits = Auth::user()->rabbits;

        return view('application.matings', compact(['matings', 'rabbits']));
    }

    function addMating(Request $request)
    {
        $this->validate($request, [
            'female' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,f',
            'male' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,m',
            'date' => 'nullable|date',
            'birth_date' => 'nullable|date',
            'child_count' => 'nullable|integer',
            'alive_count' => 'nullable|integer',
            'desc' => 'nullable|string|max:255',
        ]);

        if (empty($request->female)
            && empty($request->male)
            && empty($request->date)
            && empty($request->birth_date)
            && empty($request->child_count)
            && empty($request->alive_count)
            && empty($request->desc)) {
            return back()->withErrors('-_-');
        }

        $mating = new Mating();
        $mating->user_id = Auth::id();
        $mating->female_id = $request->female;
        $mating->male_id = $request->male;
        $mating->date = $request->date;
        $mating->date_birth = $request->date_birth;
        $mating->child_count = $request->child_count;
        $mating->alive_count = $request->alive_count;
        $mating->desc = $request->desc;
        $mating->save();

        return redirect(route('matings'));
    }

    function editMating(Request $request, $id) {
        $this->validate($request, [
            'female' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,f',
            'male' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id() . '|exists:rabbits,id,gender,m',
            'date' => 'nullable|date',
            'birth_date' => 'nullable|date',
            'child_count' => 'nullable|integer',
            'alive_count' => 'nullable|integer',
            'desc' => 'nullable|string|max:255',
        ]);

        if (empty($request->female)
            && empty($request->male)
            && empty($request->date)
            && empty($request->birth_date)
            && empty($request->child_count)
            && empty($request->alive_count)
            && (empty($request->desc) || $request->desc == '(нет)')) {
            return back()->withErrors('должны быть хоть какие-нибудь данные');
        }

        $mating = Auth::user()->matings()->findOrFail($id);

        $mating->female_id = $request->female;
        $mating->male_id = $request->male;
        $mating->date = $request->date;
        $mating->date_birth = $request->date_birth;
        $mating->child_count = $request->child_count;
        $mating->alive_count = $request->alive_count;
        $mating->desc = $request->desc;

        $mating->save();

        return redirect(route('matings'));
    }

    function deleteMating($id) {
        $mating = Auth::user()->matings()->findOrFail($id);

        $mating->delete();

        return redirect(route('matings'));
    }
}
