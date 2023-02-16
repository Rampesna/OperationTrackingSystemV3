<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class EarthquakeInformationController extends Controller
{
    public function index()
    {
        return view('employee.modules.earthquakeInformation.index.index');
    }
}
