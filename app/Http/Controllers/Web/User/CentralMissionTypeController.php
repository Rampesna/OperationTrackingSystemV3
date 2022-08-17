<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class CentralMissionTypeController extends Controller
{
    public function index()
    {
        return view('user.modules.centralMissionType.index.index');
    }
}
