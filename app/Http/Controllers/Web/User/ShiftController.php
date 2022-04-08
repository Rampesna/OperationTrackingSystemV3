<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class ShiftController extends Controller
{
    public function index()
    {
        return view('user.modules.shift.index.index');
    }
}
