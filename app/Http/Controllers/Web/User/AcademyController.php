<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class AcademyController extends Controller
{
    public function index()
    {
        return view('user.modules.academy.index.index');
    }
}
