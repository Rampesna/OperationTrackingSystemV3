<?php

namespace App\Http\Controllers\Web\User\SantralMonitoring;

use App\Http\Controllers\Controller;

class MonitorController extends Controller
{
    public function job()
    {
        return view('user.modules.santralMonitoring.monitor.job.index');
    }

    public function employee()
    {
        return view('user.modules.santralMonitoring.monitor.employee.index');
    }

    public function achievement()
    {
        return view('user.modules.santralMonitoring.monitor.achievement.index');
    }
}
