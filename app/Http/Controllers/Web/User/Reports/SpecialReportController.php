<?php

namespace App\Http\Controllers\Web\User\Reports;

use App\Http\Controllers\Controller;

class SpecialReportController extends Controller
{
    public function index()
    {
        return view('user.modules.report.reports.special.index');
    }
}
