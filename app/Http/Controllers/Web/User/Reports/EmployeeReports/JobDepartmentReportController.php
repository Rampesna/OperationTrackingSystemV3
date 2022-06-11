<?php

namespace App\Http\Controllers\Web\User\Reports\EmployeeReports;

use App\Http\Controllers\Controller;

class JobDepartmentReportController extends Controller
{
    public function index()
    {
        return view('user.modules.report.reports.employee.reports.jobDepartment.index');
    }
}
