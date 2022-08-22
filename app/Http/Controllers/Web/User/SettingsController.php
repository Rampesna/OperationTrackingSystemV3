<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        return view('user.modules.settings.index.index');
    }

    public function company()
    {
        return view('user.modules.settings.company.index.index');
    }

    public function queue()
    {
        return view('user.modules.settings.queue.index.index');
    }

    public function competence()
    {
        return view('user.modules.settings.competence.index.index');
    }

    public function centralMissionStatus()
    {
        return view('user.modules.settings.centralMissionStatus.index.index');
    }

    public function centralMissionType()
    {
        return view('user.modules.settings.centralMissionType.index.index');
    }

    public function jobDepartment()
    {
        return view('user.modules.settings.jobDepartment.index.index');
    }

    public function jobDepartmentType()
    {
        return view('user.modules.settings.jobDepartmentType.index.index');
    }

    public function shiftGroup()
    {
        return view('user.modules.settings.shiftGroup.index.index');
    }

    public function user()
    {
        return view('user.modules.settings.user.index.index');
    }

    public function userRole()
    {
        return view('user.modules.settings.userRole.index.index');
    }
}
