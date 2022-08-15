<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class EmployeeSuggestionController extends Controller
{
    public function index()
    {
        return view('employee.modules.employeeSuggestion.index.index');
    }
}
