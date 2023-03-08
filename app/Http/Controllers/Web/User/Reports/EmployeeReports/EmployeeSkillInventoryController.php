<?php

namespace App\Http\Controllers\Web\User\Reports\EmployeeReports;

use App\Http\Controllers\Controller;

class EmployeeSkillInventoryController extends Controller
{
    public function index()
    {
        return view('user.modules.report.reports.employee.reports.employeeSkillInventory.index');
    }
}
