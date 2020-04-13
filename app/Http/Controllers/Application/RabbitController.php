<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RabbitController extends Controller
{
    function getRabbits() {
        return view('application.rabbits');
    }

    function getRabbit() {
        return view('application.rabbit');
    }
}
