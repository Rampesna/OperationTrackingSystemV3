<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IShiftGroupEmployeeUseListService extends IEloquentService
{
    public function initialize();

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function create(
        int $shiftGroupId,
        int $employeeId
    );

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function setShiftGroupEmployeesNotUsed(
        int $shiftGroupId
    );

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function getUsableShiftGroupEmployees(
        int $shiftGroupId
    );

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function getUsedShiftGroupEmployees(
        int $shiftGroupId
    );

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function setUsedShiftGroupEmployee(
        int $shiftGroupId,
        int $employeeId
    );
}
