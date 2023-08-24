<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Controller;

class SocialEventController extends Controller
{
    public function index()
    {
        return view('employee.modules.socialEvent.index.index');
    }
}
