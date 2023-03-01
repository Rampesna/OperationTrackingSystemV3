<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ISpecialInformationService extends IEloquentService
{
    /**
     * @param int $employeeId
     */
    public function checkIfExists(
        int $employeeId
    ): ServiceResponse;

    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    ): ServiceResponse;

    /**
     * @param array $companyIds
     */
    public function getUnregisteredByCompanyIds(
        array $companyIds
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
     * @param string|null $currentOffice
     * @param string|null $address
     * @param string|null $workingStatus
     * @param string|null $generalStatus
     * @param string|null $generalEquipmentStatus
     * @param string|null $computerStatus
     * @param string|null $internetStatus
     * @param string|null $headphoneStatus
     * @param string|null $workableDate
     * @param string|null $generalNotes
     *
     * @return ServiceResponse
     */
    public function create(
        int         $employeeId,
        string|null $city,
        string|null $currentOffice,
        string|null $address,
        string|null $workingStatus,
        string|null $generalStatus,
        string|null $generalEquipmentStatus,
        string|null $computerStatus,
        string|null $internetStatus,
        string|null $headphoneStatus,
        string|null $workableDate,
        string|null $generalNotes
    ): ServiceResponse;

    /**
     * @param int $employeeId
     * @param string|null $city
     * @param string|null $currentOffice
     * @param string|null $address
     * @param string|null $workingStatus
     * @param string|null $generalStatus
     * @param string|null $generalEquipmentStatus
     * @param string|null $computerStatus
     * @param string|null $internetStatus
     * @param string|null $headphoneStatus
     * @param string|null $workableDate
     * @param string|null $generalNotes
     *
     * @return ServiceResponse
     */
    public function update(
        int         $employeeId,
        string|null $city,
        string|null $currentOffice,
        string|null $address,
        string|null $workingStatus,
        string|null $generalStatus,
        string|null $generalEquipmentStatus,
        string|null $computerStatus,
        string|null $internetStatus,
        string|null $headphoneStatus,
        string|null $workableDate,
        string|null $generalNotes
    ): ServiceResponse;
}
