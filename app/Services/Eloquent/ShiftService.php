<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IShiftService;
use App\Models\Eloquent\Shift;
use App\Interfaces\Eloquent\IEmployeeService;

class ShiftService implements IShiftService
{
    private $employeeService;

    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function getAll()
    {
        return Shift::all();
    }

    public function getById(int $id)
    {
        return Shift::find($id);
    }

    public function delete(int $id)
    {
        return Shift::destroy($id);
    }

    /**
     * @param int $companyId
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     */
    public function getByCompanyId(
        int         $companyId,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds
    )
    {
        $shifts = Shift::with([
            'employee',
            'shiftGroup'
        ])->where('company_id', $companyId)
            ->whereBetween('start_date', [$startDate, $endDate])
            ->get();

        if ($keyword || $jobDepartmentIds) {
            $employees = $this->employeeService->getByCompanies(0, 1000, [$companyId]);

            if ($keyword) {
                $employees = $employees->where('name', 'like', '%' . $keyword . '%')->all();
            }

            if ($jobDepartmentIds) {
                $employees = $employees->whereIn('job_department_id', $jobDepartmentIds)->all();
            }

            $shifts->whereIn('employee_id', $employees->pluck('id')->toArray());
        }

        return $shifts;
    }

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     */
    public function getByCompanyIds(
        array       $companyIds,
        string      $startDate,
        string      $endDate,
        string|null $keyword = null,
        array|null  $jobDepartmentIds
    )
    {
        $shifts = Shift::with([
            'employee',
            'shiftGroup'
        ])->whereIn('company_id', $companyIds)
            ->whereBetween('start_date', [$startDate, $endDate]);

        if ($keyword || $jobDepartmentIds) {
            $shifts->whereIn(
                'employee_id',
                $this->employeeService->getByCompanies(0, 1000, $companyIds, 0, $keyword, $jobDepartmentIds)->pluck('id')->toArray()
            );
        }

        return $shifts->get();
    }
}
