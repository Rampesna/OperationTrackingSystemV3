<?php

namespace App\Http\Controllers\Web\User\Employee;

use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function index()
    {
        return view('user.modules.employee.info.index.index');
    }
}
