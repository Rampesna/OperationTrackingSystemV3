<?php

namespace App\Interfaces\Eloquent;

interface IShiftGroupEmployeeUseListService extends IEloquentService
{
    public function initialize();

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     */
    public function create(
        int $shiftGroupId,
        int $employeeId
    );

    /**
     * @param int $shiftGroupId
     */
    public function setShiftGroupEmployeesNotUsed(
        int $shiftGroupId
    );

    /**
     * @param int $shiftGroupId
     */
    public function getUsableShiftGroupEmployees(
        int $shiftGroupId
    );

    /**
     * @param int $shiftGroupId
     */
    public function getUsedShiftGroupEmployees(
        int $shiftGroupId
    );

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     */
    public function setUsedShiftGroupEmployee(
        int $shiftGroupId,
        int $employeeId
    );
}
