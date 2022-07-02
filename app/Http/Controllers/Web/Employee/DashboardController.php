<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('employee.modules.dashboard.index.index');
    }
}
