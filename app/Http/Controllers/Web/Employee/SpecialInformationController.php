<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class SpecialInformationController extends Controller
{
    public function index()
    {
        return view('employee.modules.specialInformation.index.index');
    }
}
