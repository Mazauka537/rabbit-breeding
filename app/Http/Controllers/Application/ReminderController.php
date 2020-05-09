<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\Application\ReminderAddRequest;
use App\Reminder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function Sodium\add;

class ReminderController extends Controller
{
    private function getThemePath()
    {
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

    private function todayFirst($reminders)
    {
        $result = new Collection();
        foreach ($reminders as $reminder) {
            if ($reminder->date == date('Y-m-d')) {
                $result[] = $reminder;
            }
        }
        foreach ($reminders as $reminder) {
            if ($reminder->date != date('Y-m-d')) {
                $result[] = $reminder;
            }
        }
        return $result;
    }

    function getReminders()
    {
        $user = Auth::user();
        if ($user->days_for_delete_reminders != 0) {
            if ($user->delete_only_checked_reminders) {
                $user->reminders()
                    ->where('checked', true)
                    ->whereDate('date', '<=', date('Y-m-d', time() - $user->days_for_delete_reminders * 3600 * 24))
                    ->delete();
            } else {
                $user->reminders()
                    ->whereDate('date', '<=', date('Y-m-d', time() - $user->days_for_delete_reminders * 3600 * 24))
                    ->delete();
            }
        }
        $reminders = Auth::user()->reminders()->orderByDesc('date')->with('rabbit')->get();
        $reminders = $this->todayFirst($reminders);
        $rabbits = Auth::user()->rabbits;
        $theme = $this->getThemePath();

        return view('application.reminders', compact(['reminders', 'rabbits', 'theme']));
    }

    function addReminder(ReminderAddRequest $request)
    {
        $reminder = new Reminder();

        $reminder->date = $request->date;
        $reminder->text = $request->text;
        $reminder->rabbit_id = $request->rabbit;
        $reminder->user_id = Auth::id();

        $reminder->save();

        session()->flash('message', ['Новое напоминание успешно добавлено.']);

        return back();
    }

    function editReminder(ReminderAddRequest $request, $id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);

        $reminder->date = $request->date;
        $reminder->text = $request->text;
        $reminder->rabbit_id = $request->rabbit;

        $reminder->save();

        session()->flash('message', ['Напоминание успешно изменено.']);

        return back();
    }

    function deleteReminder($id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);

        $reminder->delete();

        session()->flash('message', ['Напоминание успешно удалено.']);

        return back();
    }

    function checkReminder($id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);
        $reminder->checked = true;
        $reminder->save();
        return response('+');
    }

    function uncheckReminder($id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);
        $reminder->checked = false;
        $reminder->save();
        return response('+');
    }

    function getTodayCount()
    {
        $count = Auth::user()->reminders()->where('date', date('Y-m-d'))->where('checked', false)->count();
        return response($count);
    }
}
