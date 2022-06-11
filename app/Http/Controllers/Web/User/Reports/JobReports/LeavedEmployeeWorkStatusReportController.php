<?php

namespace App\Http\Controllers\Web\User\Reports\JobReports;

use App\Http\Controllers\Controller;

class LeavedEmployeeWorkStatusReportController extends Controller
{
    public function index()
    {
        return view('user.modules.report.reports.job.reports.leavedEmployeeWorkStatus.index');
    }
}
