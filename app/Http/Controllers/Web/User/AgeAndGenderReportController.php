<?php

namespace App\Http\Controllers\Web\User;

use App\Exports\UserAgeAndGenderReportExport;
use App\Http\Controllers\Controller;
use App\Models\Eloquent\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AgeAndGenderReportController extends Controller
{
    private function calculateAge($birthDate)
    {
        $birthDate = Carbon::parse($birthDate);
        $now = Carbon::now();
        $age = $birthDate->diffInYears($now);

        return $age;
    }

    public function downloadAgeAndGenderReport(Request $request)
    {
        $companyIds = explode(',', $request->companyIds);
        $employees = Employee::with([
            'personalInformation',
        ])->whereIn('company_id', $companyIds)->where('leave', 0)->get();

        $employeeAgeAndGenders = collect();
        foreach ($employees as $employee) {
            $employeeAgeAndGenders->push([
                'name' => $employee->name,
                'age' => $employee->personalInformation?->birth_date ? $this->calculateAge($employee->personalInformation->birth_date) : '',
                'gender' => $employee->personalInformation?->gender == 1 ? 'Erkek' : 'Kadın'
            ]);
        }

        return Excel::download(new UserAgeAndGenderReportExport($employeeAgeAndGenders), 'Yaş & Cinsiyet Raporu.xlsx');
    }
}
