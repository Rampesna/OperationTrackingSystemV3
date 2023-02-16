<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface IEarthquakeInformationService extends IEloquentService
{
    /**
     * @param int $employeeId
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param int $cityId
     * @param string $address
     * @param int $homeStatus
     * @param bool $familyHealthStatus
     * @param bool $workStatus
     * @param bool $computerStatus
     * @param bool $internetStatus
     * @param bool $headphoneStatus
     */
    public function create(
        int    $employeeId,
        int    $cityId,
        string $address,
        int    $homeStatus,
        bool   $familyHealthStatus,
        bool   $workStatus,
        bool   $computerStatus,
        bool   $internetStatus,
        bool   $headphoneStatus
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $cityId
     * @param string $address
     * @param int $homeStatus
     * @param bool $familyHealthStatus
     * @param bool $workStatus
     * @param bool $computerStatus
     * @param bool $internetStatus
     * @param bool $headphoneStatus
     */
    public function update(
        int         $employeeId,
        string|null $cityId,
        string|null $address,
        string|null $homeStatus,
        string|null $familyHealthStatus,
        string|null $workStatus,
        string|null $computerStatus,
        string|null $internetStatus,
        string|null $headphoneStatus
    ): ServiceResponse;
}
