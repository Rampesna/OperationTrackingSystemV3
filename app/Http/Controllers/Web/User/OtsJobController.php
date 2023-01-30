<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class OtsJobController extends Controller
{
    public function index()
    {
        return view('user.modules.otsJob.index2.index');
    }
}
