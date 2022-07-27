<?php

namespace App\Http\Controllers\Web\User\HumanResources;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function ageAndGender()
    {
        return view('user.modules.humanResources.report.ageAndGender.index');
    }

    public function education()
    {
        return view('user.modules.humanResources.report.education.index');
    }

    public function bloodGroup()
    {
        return view('user.modules.humanResources.report.bloodGroup.index');
    }

    public function permit()
    {
        return view('user.modules.humanResources.report.permit.index');
    }

    public function overtime()
    {
        return view('user.modules.humanResources.report.overtime.index');
    }

    public function payment()
    {
        return view('user.modules.humanResources.report.payment.index');
    }
}
