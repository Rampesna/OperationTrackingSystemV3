<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('user.modules.employee.index.index');
    }
}
