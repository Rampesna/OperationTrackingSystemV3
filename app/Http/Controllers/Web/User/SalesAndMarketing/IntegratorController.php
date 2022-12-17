<?php

namespace App\Http\Controllers\Web\User\SalesAndMarketing;

use App\Http\Controllers\Controller;

class IntegratorController extends Controller
{
    public function index()
    {
        return view('user.modules.salesAndMarketing.modules.integrator.index');
    }
}
