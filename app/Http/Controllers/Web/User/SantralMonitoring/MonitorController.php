<?php

namespace App\Http\Controllers\Web\User\SantralMonitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function job()
    {
        return view('user.modules.santralMonitoring.monitor.job.index');
    }

    public function employee(Request $request)
    {
        return view('user.modules.santralMonitoring.monitor.employee.index', [
            'employeeMonitoringType' => $request->employeeMonitoringType,
            'employeeMonitoringCompanyIds' => $request->employeeMonitoringCompanyIds,
            'employeeMonitoringJobDepartmentTypeIds' => $request->employeeMonitoringJobDepartmentTypeIds
        ]);
    }

    public function achievement(Request $request)
    {
        return view('user.modules.santralMonitoring.monitor.achievement.index', [
            'achievementMonitoringType' => $request->achievementMonitoringType,
            'achievementMonitoringCompanyIds' => $request->achievementMonitoringCompanyIds,
            'achievementMonitoringJobDepartmentTypeIds' => $request->achievementMonitoringJobDepartmentTypeIds
        ]);
    }
}
