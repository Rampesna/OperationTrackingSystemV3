<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class ShiftGroupController extends Controller
{
    public function index()
    {
        return view('user.modules.shiftGroup.index.index');
    }
}
