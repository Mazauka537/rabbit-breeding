<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CageController extends Controller
{
    function getCages() {
        return view('application.cages');
    }

    function getCage() {
        return view('application.cage');
    }

    function addCage() {
        return redirect(route('cages'));
    }
}
