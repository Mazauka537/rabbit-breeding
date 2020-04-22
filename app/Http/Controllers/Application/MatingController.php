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
        $errors = [];

        if (empty($request->female)
            && empty($request->male)
            && empty($request->date)
            && empty($request->birth_date)
            && empty($request->child_count)
            && empty($request->alive_count)
            && empty($request->desc)) {
            $errors[] = '-_-';
        }

        if (!empty($request->child_count) && !empty($request->alive_count)) {
            if ($request->child_count < $request->alive_count)
                $errors[] = 'Число выживших крольчат не может превышать число рожденных';
        }

        if (!empty($request->date) && !empty($request->date_birth)) {
            if (strtotime($request->date) > strtotime($request->date_birth))
                $errors[] = 'Дата окрола не может быть раньше даты случки';
        }

        if (!empty($errors))
            return back()->withErrors($errors);

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
        $errors = [];

        if (empty($request->female)
            && empty($request->male)
            && empty($request->date)
            && empty($request->birth_date)
            && empty($request->child_count)
            && empty($request->alive_count)
            && (empty($request->desc) || $request->desc == '(нет)')) {
            return $this->error('Должны быть хоть какие-нибудь данные');
        }

        $mating = Auth::user()->matings()->findOrFail($id);

        $mating->female_id = $request->female;
        $mating->male_id = $request->male;
        $mating->date = $request->date;
        $mating->date_birth = $request->date_birth;
        $mating->child_count = $request->child_count;
        $mating->alive_count = $request->alive_count;
        $mating->desc = $request->desc;

        if (!empty($mating->child_count) && !empty($mating->alive_count)) {
            if ($mating->child_count < $mating->alive_count)
                $errors[] = 'Число выживших крольчат не может превышать число рожденных';
        }

        if (!empty($mating->date) && !empty($mating->date_birth)) {
            if (strtotime($mating->date) > strtotime($mating->date_birth))
                $errors[] = 'Дата окрола не может быть раньше даты случки';
        }

        if (!empty($errors))
            return back()->withErrors($errors);

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
