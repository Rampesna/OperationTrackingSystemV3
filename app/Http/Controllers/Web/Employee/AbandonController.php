<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class AbandonController extends Controller
{
    public function index()
    {
        return view('employee.modules.abandon.index.index');
    }
}
