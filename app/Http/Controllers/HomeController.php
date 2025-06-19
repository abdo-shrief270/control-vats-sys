<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home():View
    {
        return view('index');
    }

    public function activityLogs():View
    {
        return view('logs');
    }

    public function automaticControl():View
    {
        return view('auto');
    }

    public function liveStream():View
    {
        return view('live');
    }

    public function carStatus():View
    {
        return view('status');
    }
}
