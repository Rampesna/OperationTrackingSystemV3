<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class CentralMissionStatusController extends Controller
{
    public function index()
    {
        return view('user.modules.centralMissionStatus.index.index');
    }
}
