<?php

namespace App\Http\Controllers\Application;

use App\DefaultNotify;
use App\Http\Controllers\Controller;
use App\Http\Requests\Application\DefaultMatingNotifyAddRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultNotifyController extends Controller
{
    public function addDefaultMatingNotify(DefaultMatingNotifyAddRequest $request)
    {
        $defaultNotify = new DefaultNotify();

        $defaultNotify->user_id = Auth::id();
        $defaultNotify->days = $request->days;
        $defaultNotify->text = $request->text;

        $defaultNotify->save();

        session()->flash('message', ['Новое напоминание успешно добавлено.']);

        return back();
    }

    public function editDefaultMatingNotify(DefaultMatingNotifyAddRequest $request, $id)
    {
        $defaultNotify = Auth::user()->defaultNotifies()->findOrFail($id);

        $defaultNotify->days = $request->days;
        $defaultNotify->text = $request->text;

        $defaultNotify->save();

        session()->flash('message', ['Напоминание успешно изменено.']);

        return back();
    }

    function deleteDefaultMatingNotify($id)
    {
        $defaultNotify = Auth::user()->defaultNotifies()->findOrFail($id);

        $defaultNotify->delete();

        session()->flash('message', ['Напоминание успешно удалено.']);

        return back();
    }
}
