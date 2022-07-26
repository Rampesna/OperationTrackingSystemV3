<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class HumanResourcesController extends Controller
{
    public function index()
    {
        return view('user.modules.humanResources.index.index');
    }

    public function dashboard()
    {
        return view('user.modules.humanResources.dashboard.index');
    }

    public function calendar()
    {
        return view('user.modules.humanResources.calendar.index');
    }

    public function permit()
    {
        return view('user.modules.humanResources.permit.index');
    }

    public function overtime()
    {
        return view('user.modules.humanResources.overtime.index');
    }

    public function payment()
    {
        return view('user.modules.humanResources.payment.index');
    }

    public function report()
    {
        return view('user.modules.humanResources.report.index');
    }
}
