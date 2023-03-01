<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class SpecialInformationController extends Controller
{
    public function index()
    {
        return view('user.modules.specialInformation.index.index');
    }

    public function employee()
    {
        return view('user.modules.specialInformation.employee.index');
    }
}
