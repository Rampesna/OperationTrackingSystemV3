<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class ScreenMonitoringController extends Controller
{
    public function index()
    {
        return view('user.modules.screenMonitoring.index.index');
    }
}
