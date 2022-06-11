<?php

namespace App\Http\Controllers\Web\User\Reports;

use App\Http\Controllers\Controller;

class JobReportController extends Controller
{
    public function index()
    {
        return view('user.modules.report.reports.job.index.index');
    }
}
