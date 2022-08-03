<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPositionService;
use App\Models\Eloquent\Position;
use App\Services\ServiceResponse;

class PositionService implements IPositionService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All positions',
            200,
            Position::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $position = Position::with([
            'employee',
            'company',
            'branch',
            'department',
            'title',
        ])->find($id);
        if ($position) {
            return new ServiceResponse(
                true,
                'Position',
                200,
                $position
            );
        } else {
            return new ServiceResponse(
                false,
                'Position not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $position = $this->getById($id);
        if ($position->isSuccess()) {
            return new ServiceResponse(
                true,
                'Position deleted',
                200,
                $position->getData()->delete()
            );
        } else {
            return $position;
        }
    }

    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Position',
            200,
            Position::with([
                'employee',
                'company',
                'branch',
                'department',
                'title',
            ])->where('employee_id', $employeeId)->get()
        );
    }

    /**
     * @param int $employeeId
     * @param int $companyId
     * @param int $branchId
     * @param int $departmentId
     * @param int $titleId
     * @param string $startDate
     * @param string|null $endDate
     * @param int|null $leavingReasonId
     * @param float|null $salary
     * @param string|null $salaryPayType
     * @param float|null $bounty
     * @param float|null $roadToll
     *
     * @return ServiceResponse
     */
    public function create(
        int     $employeeId,
        int     $companyId,
        int     $branchId,
        int     $departmentId,
        int     $titleId,
        string  $startDate,
        ?string $endDate,
        ?int    $leavingReasonId,
        ?float  $salary,
        ?string $salaryPayType,
        ?float  $bounty,
        ?float  $roadToll
    ): ServiceResponse
    {
        $position = new Position;
        $position->employee_id = $employeeId;
        $position->company_id = $companyId;
        $position->branch_id = $branchId;
        $position->department_id = $departmentId;
        $position->title_id = $titleId;
        $position->start_date = $startDate;
        $position->end_date = $endDate;
        $position->leaving_reason_id = $leavingReasonId;
        $position->salary = $salary;
        $position->salary_pay_type = $salaryPayType;
        $position->bounty = $bounty;
        $position->road_toll = $roadToll;
        $position->save();
        return new ServiceResponse(
            true,
            'Position created',
            201,
            $position
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param int $branchId
     * @param int $departmentId
     * @param int $titleId
     * @param string $startDate
     * @param string|null $endDate
     * @param int|null $leavingReasonId
     * @param float|null $salary
     * @param string|null $salaryPayType
     * @param float|null $bounty
     * @param float|null $roadToll
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $companyId,
        int     $branchId,
        int     $departmentId,
        int     $titleId,
        string  $startDate,
        ?string $endDate,
        ?int    $leavingReasonId,
        ?float  $salary,
        ?string $salaryPayType,
        ?float  $bounty,
        ?float  $roadToll
    ): ServiceResponse
    {
        $position = $this->getById($id);
        if ($position->isSuccess()) {
            $position->getData()->company_id = $companyId;
            $position->getData()->branch_id = $branchId;
            $position->getData()->department_id = $departmentId;
            $position->getData()->title_id = $titleId;
            $position->getData()->start_date = $startDate;
            $position->getData()->end_date = $endDate;
            $position->getData()->leaving_reason_id = $leavingReasonId;
            $position->getData()->salary = $salary;
            $position->getData()->salary_pay_type = $salaryPayType;
            $position->getData()->bounty = $bounty;
            $position->getData()->road_toll = $roadToll;
            $position->getData()->save();
            return new ServiceResponse(
                true,
                'Position updated',
                200,
                $position->getData()
            );
        } else {
            return $position;
        }
    }
}
