<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class PerformanceController extends Controller
{
    public function index()
    {
        return view('employee.modules.performance.index.index');
    }
}
