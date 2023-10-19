<?php

namespace App\Http\Controllers\Web\User;

use App\Exports\UserPermitReportExport;
use App\Http\Controllers\Controller;
use App\Models\Eloquent\Permit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PermitReportController extends Controller
{
    function minutesToString($minutes)
    {
        $remainingMinutes = $minutes % 60;
        $hours = floor($minutes / 60);

        $hoursPart = $hours > 0 ? $hours . ' Saat ' : '';
        $minutesPart = $remainingMinutes > 0 ? $remainingMinutes . ' Dakika' : '';

        return $hoursPart . $minutesPart;
    }

    public function downloadPermitReport(Request $request)
    {
        $employeeIds = explode(',', $request->employeeIds);
        $typeIds = explode(',', $request->typeIds);
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $permits = Permit::with([
            'employee'
        ])->whereIn('employee_id', $employeeIds)->whereIn('type_id', $typeIds)->where(function ($permits) use ($startDate, $endDate) {
            $permits->whereBetween('start_date', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ])->
            orWhere(function ($permits) use ($startDate, $endDate) {
                $permits->whereBetween('end_date', [
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                ]);
            })->
            orWhere(function ($permits) use ($startDate, $endDate) {
                $permits->where('start_date', '<=', $startDate)->where('end_date', '>=', $endDate);
            });
        })->where('status_id', 2)->get();

        $start = $startDate . ' 09:00:00';
        $end = $endDate . ' 18:00:00';
        $employees = [];
        $employeePermits = collect($permits)->groupBy('employee_id');
        foreach ($employeePermits as $i => $permits) {
            $minutes = 0;
            foreach ($permits as $j => $permit) {
                $startDate = $permit->start_date < $start ? $start : $permit['start_date'];
                $endDate = $permit->end_date > $end ? $end : $permit['end_date'];
                $minutes += calculateMinutes($startDate, $endDate);
            }
            array_push($employees, array(
                'name' => $permits[0]['employee']['name'],
                'duration' => $this->minutesToString($minutes),
            ));
        }

        return Excel::download(new UserPermitReportExport($employees), 'İzin Raporu.xlsx');
    }
}
