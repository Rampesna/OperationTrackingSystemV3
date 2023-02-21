<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IEarthquakeInformationService extends IEloquentService
{
    /**
     * @param int $employeeId
     */
    public function checkIfExists(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $employeeId
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string|null $city
     * @param string|null $address
     * @param string|null $homeStatus
     * @param string|null $familyHealthStatus
     * @param string|null $workingStatus
     * @param string|null $workingAddress
     * @param string|null $workingDepartment
     * @param string|null $workableDate
     * @param string|null $computerStatus
     * @param string|null $internetStatus
     * @param string|null $headphoneStatus
     * @param string|null $generalNotes
     *
     * @return ServiceResponse
     */
    public function create(
        int         $employeeId,
        string|null $city,
        string|null $address,
        string|null $homeStatus,
        string|null $familyHealthStatus,
        string|null $workingStatus,
        string|null $workingAddress,
        string|null $workingDepartment,
        string|null $workableDate,
        string|null $computerStatus,
        string|null $internetStatus,
        string|null $headphoneStatus,
        string|null $generalNotes
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string|null $city
     * @param string|null $address
     * @param string|null $homeStatus
     * @param string|null $familyHealthStatus
     * @param string|null $workingStatus
     * @param string|null $workingAddress
     * @param string|null $workingDepartment
     * @param string|null $workableDate
     * @param string|null $computerStatus
     * @param string|null $internetStatus
     * @param string|null $headphoneStatus
     * @param string|null $generalNotes
     *
     * @return ServiceResponse
     */
    public function update(
        int         $employeeId,
        string|null $city,
        string|null $address,
        string|null $homeStatus,
        string|null $familyHealthStatus,
        string|null $workingStatus,
        string|null $workingAddress,
        string|null $workingDepartment,
        string|null $workableDate,
        string|null $computerStatus,
        string|null $internetStatus,
        string|null $headphoneStatus,
        string|null $generalNotes
    ): ServiceResponse;
}
