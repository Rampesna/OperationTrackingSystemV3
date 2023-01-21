<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class PerformanceController extends Controller
{
    public function index()
    {
        return view('user.modules.performance.index.index');
    }

    public function prCard()
    {
        return view('user.modules.performance.prCard.index');
    }

    public function prCritter()
    {
        return view('user.modules.performance.prCritter.index');
    }
}
