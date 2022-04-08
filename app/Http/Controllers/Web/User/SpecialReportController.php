<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class SpecialReportController extends Controller
{
    public function index()
    {
        return view('user.modules.specialReport.index.index');
    }
}
