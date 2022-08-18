<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.modules.employee.index.index');
    }
}
