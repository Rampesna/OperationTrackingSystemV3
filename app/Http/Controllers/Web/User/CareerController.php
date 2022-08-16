<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index()
    {
        return view('user.modules.career.index.index');
    }
}
