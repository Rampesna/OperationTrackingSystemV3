<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class RecruitingController extends Controller
{
    public function index()
    {
        return view('user.modules.recruiting.index.index');
    }
}