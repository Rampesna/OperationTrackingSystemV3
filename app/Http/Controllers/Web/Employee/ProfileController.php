<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('employee.modules.profile.index.index');
    }
}
