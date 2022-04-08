<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class SantralMonitoringController extends Controller
{
    public function index()
    {
        return view('user.modules.santralMonitoring.index.index');
    }
}
