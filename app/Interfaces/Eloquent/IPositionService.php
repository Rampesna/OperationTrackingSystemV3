<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IPositionService extends IEloquentService
{
    /**
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse;

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
    ): ServiceResponse;

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
    ): ServiceResponse;
}
