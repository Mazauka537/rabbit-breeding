<?php

namespace App\Http\Controllers\Application;

use App\DefaultNotify;
use App\Http\Requests\Application\MatingAddRequest;
use App\Http\Requests\Application\MatingsGetRequest;
use App\Mating;
use App\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MatingController extends Controller
{
    private function setRabbitStatus($status)
    {
        switch ($status) {
            case 'young':
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

    private function getThemePath() {
        $theme = Auth::user()->theme;
        if (!empty($theme)) {
            $themes = json_decode(file_get_contents('application/themes.json'));

            foreach ($themes as $key => $value) {
                if ($key == $theme) {
                    $theme = $value->path;
                    break;
                }
            }
        }

        return $theme;
    }

    function getMatings(MatingsGetRequest $request)
    {
        $user = Auth::user();
        $perPage = $user->pagination;
        $pageCount = ceil(Auth::user()->matings()->count() / $perPage);

        if (!$request->has('page')) $request->page = 1;
        if (!$request->has('sortby')) $request->sortby = 'date';
        $sortby = $request->sortby;

        $theme = $this->getThemePath();

        $matings = Auth::user()
            ->matings()
            ->leftJoin('rabbits as female_rabbits', 'matings.female_id', '=', 'female_rabbits.id')
            ->leftJoin('rabbits as male_rabbits', 'matings.male_id', '=', 'male_rabbits.id')
            ->select('matings.*', 'female_rabbits.name as female_name', 'male_rabbits.name as male_name')
            ->orderByDesc($sortby)
            ->offset($perPage * abs($request->page - 1))
            ->limit($perPage)
            ->get();

        $rabbits = Auth::user()->rabbits;

        foreach ($rabbits as $rabbit) {
            $rabbit->status_value = $this->setRabbitStatus($rabbit->status);
        }

        return view('application.matings', compact(['matings', 'rabbits', 'pageCount', 'theme', 'sortby', 'user']));
    }

    function addMating(MatingAddRequest $request)
    {
        $errors = [];
        $messages = [];

        if (!empty($request->child_count) && !empty($request->alive_count)) {
            if ($request->child_count < $request->alive_count)
                $errors[] = 'Число выживших крольчат не может превышать число рожденных';
        }

        if (!empty($request->date) && !empty($request->date_birth)) {
            if (strtotime($request->date) > strtotime($request->date_birth))
                $errors[] = 'Дата окрола не может быть раньше даты случки';
        }

        if (!empty($errors)) {
            $request->flash();
            return back()->withErrors($errors);
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

        $messages[] = 'Новая случка успешно добавлена.';

        if ($request->notify) {
            $notifiesData = [];
            $defaultNotifies = Auth::user()->defaultNotifies;
            if (count($defaultNotifies) != 0) {
                foreach ($defaultNotifies as $dnotify) {
                    $notifiesData[] = [
                        'user_id' => Auth::id(),
                        'text' => $dnotify->text,
                        'date' => date('Y-m-d', $dnotify->days * 60 * 60 * 24 + time()),
                        'rabbit_id' => $request->female,
                    ];
                }
                Reminder::insert($notifiesData);
                $messages[] = 'Напоминания успешно добавлены.';
            } else {
                $errors[] = 'Стандартные напоминания не назначены. Вы можете назначить их в настройках.';
            }
        }

        session()->flash('message', $messages);

        return back()->withErrors($errors);
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

        if (!empty($errors)) {
            return back()->withErrors($errors);
        }

        $mating->save();

        session()->flash('message', ['Случка успешно изменена.']);

        return back();
    }

    function deleteMating($id)
    {
        $mating = Auth::user()->matings()->findOrFail($id);

        $mating->delete();

        session()->flash('message', ['Случка успешно удалена.']);

        return back();
    }
}
