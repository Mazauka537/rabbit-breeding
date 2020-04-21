<?php

namespace App\Http\Controllers\Application;

use App\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    function getReminders()
    {
        $reminders = Auth::user()->reminders()->orderBy('date')->with('rabbit')->get();
        $rabbits = Auth::user()->rabbits;

        return view('application.reminders', compact(['reminders', 'rabbits']));
    }

    function addReminder(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'text' => 'required|string|max:255',
            'rabbit' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id(),
        ]);

        $reminder = new Reminder();

        $reminder->date = $request->date;
        $reminder->text = $request->text;
        $reminder->rabbit_id = $request->rabbit;
        $reminder->user_id = Auth::id();

        $reminder->save();

        return back();
    }

    function editReminder(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'text' => 'required|string|max:255',
            'rabbit' => 'nullable|integer|exists:rabbits,id,user_id,' . Auth::id(),
        ]);

        $reminder = Auth::user()->reminders()->findOrFail($id);

        $reminder->date = $request->date;
        $reminder->text = $request->text;
        $reminder->rabbit_id = $request->rabbit;

        $reminder->save();

        return back();
    }

    function deleteReminder($id)
    {
        $reminder = Auth::user()->reminders()->findOrFail($id);

        $reminder->delete();

        return back();
    }
}
