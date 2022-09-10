<?php

namespace App\Http\Controllers\Web\User\Reports\EmployeeReports;

use App\Http\Controllers\Controller;

class MonthlyAbsenceReportController extends Controller
{
    public function index()
    {
        return view('user.modules.report.reports.employee.reports.monthlyAbsence.index');
    }
}
