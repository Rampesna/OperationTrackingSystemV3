<?php

namespace App\Http\Controllers\Web\User\HumanResources;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('user.modules.humanResources.employee.index.index');
    }
}
