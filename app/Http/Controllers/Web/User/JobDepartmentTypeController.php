<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class JobDepartmentTypeController extends Controller
{
    public function index()
    {
        return view('user.modules.jobDepartmentType.index.index');
    }
}
