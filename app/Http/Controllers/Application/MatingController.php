<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\Application\MatingAddRequest;
use App\Mating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MatingController extends Controller
{
    private function setRabbitStatus($status)
    {
        switch ($status) {
            case 'yong':
                return 'Молодняк';
            case 'ready':
                return 'Готова к спариванию';
            case 'pregnant':
                return 'Беременная';
            case 'lactation':
                return 'Лактация';
            case 'rest':
                return 'Отдых';
        }
        return null;
    }

    function getMatings()
    {
        $matings = Auth::user()->matings()->with(['female', 'male'])->get();

        $rabbits = Auth::user()->rabbits;

        foreach ($rabbits as $rabbit) {
            $rabbit->status_value = $this->setRabbitStatus($rabbit->status);
        }

        return view('application.matings', compact(['matings', 'rabbits']));
    }

    function addMating(MatingAddRequest $request)
    {
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

        return back();
    }

    function editMating(MatingAddRequest $request, $id)
    {
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

        return back();
    }

    function deleteMating($id)
    {
        $mating = Auth::user()->matings()->findOrFail($id);

        $mating->delete();

        return back();
    }
}
