<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IShiftGroupEmployeeUseListService extends IEloquentService
{
    public function initialize(): ServiceResponse;

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function create(
        int $shiftGroupId,
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function setShiftGroupEmployeesNotUsed(
        int $shiftGroupId
    ): ServiceResponse;

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function getUsableShiftGroupEmployees(
        int $shiftGroupId
    ): ServiceResponse;

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function getUsedShiftGroupEmployees(
        int $shiftGroupId
    ): ServiceResponse;

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function setUsedShiftGroupEmployee(
        int $shiftGroupId,
        int $employeeId
    ): ServiceResponse;
}
