<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ISpecialInformationService;
use App\Models\Eloquent\SpecialInformation;
use App\Models\Eloquent\Employee;
use App\Services\ServiceResponse;

class SpecialInformationService implements ISpecialInformationService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All special informations',
            200,
            SpecialInformation::with([
                'employee',
            ])->get()
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
        $specialInformation = SpecialInformation::find($id);
        if ($specialInformation) {
            return new ServiceResponse(
                true,
                'Special information found',
                200,
                $specialInformation
            );
        } else {
            return new ServiceResponse(
                false,
                'Special information not found',
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
        $specialInformation = $this->getById($id);
        if ($specialInformation->isSuccess()) {
            return new ServiceResponse(
                $specialInformation->getData()->delete(),
                'Special information deleted',
                200,
                null
            );
        } else {
            return $specialInformation;
        }
    }

    /**
     * @param int $employeeId
     */
    public function checkIfExists(
        int $employeeId
    ): ServiceResponse
    {
        $specialInformation = SpecialInformation::where('employee_id', $employeeId)->first();
        if ($specialInformation) {
            return new ServiceResponse(
                true,
                'Special information exists',
                200,
                $specialInformation
            );
        } else {
            return new ServiceResponse(
                false,
                'Special information does not exist',
                404,
                null
            );
        }
    }

    /**
     * @param array $companyIds
     */
    public function getByCompanyIds(
        array $companyIds
    ): ServiceResponse
    {
        $employees = Employee::whereIn('company_id', $companyIds)->where('leave', 0)->get();
        $specialInformations = SpecialInformation::with([
            'employee'
        ])->whereIn('employee_id', $employees->pluck('id')->toArray())->get();

        return new ServiceResponse(
            true,
            'Special informations',
            200,
            $specialInformations
        );
    }

    /**
     * @param array $companyIds
     */
    public function getUnregisteredByCompanyIds(
        array $companyIds
    ): ServiceResponse
    {
        $unregisteredEmployees = collect();
        $employees = Employee::whereIn('company_id', $companyIds)->where('leave', 0)->get();
        $specialInformations = SpecialInformation::all();

        foreach ($employees as $employee) {
            $employeeSpecialInformation = $specialInformations->where('employee_id', $employee->id)->first();
            if (!$employeeSpecialInformation) {
                $unregisteredEmployees->push($employee);
            } else if ($employeeSpecialInformation->city == '' || $employeeSpecialInformation->city == null) {
                $unregisteredEmployees->push($employee);
            }
        }

        return new ServiceResponse(
            true,
            'Unregistered employees',
            200,
            $unregisteredEmployees
        );
    }

    /**
     * @param int $employeeId
     */
    public function getByEmployeeId(
        int $employeeId
    ): ServiceResponse
    {
        $specialInformation = SpecialInformation::where('employee_id', $employeeId)->first();
        if ($specialInformation) {
            return new ServiceResponse(
                true,
                'Special information',
                200,
                $specialInformation
            );
        } else {
            $specialInformation = new SpecialInformation;
            $specialInformation->employee_id = $employeeId;
            $specialInformation->save();

            return new ServiceResponse(
                true,
                'Special information',
                200,
                $specialInformation
            );
        }
    }

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
    ): ServiceResponse
    {
        $specialInformation = new SpecialInformation;
        $specialInformation->employee_id = $employeeId;
        $specialInformation->city = $city;
        $specialInformation->current_office = $currentOffice;
        $specialInformation->address = $address;
        $specialInformation->working_status = $workingStatus;
        $specialInformation->general_status = $generalStatus;
        $specialInformation->general_equipment_status = $generalEquipmentStatus;
        $specialInformation->computer_status = $computerStatus;
        $specialInformation->internet_status = $internetStatus;
        $specialInformation->headphone_status = $headphoneStatus;
        $specialInformation->workable_date = $workableDate;
        $specialInformation->general_notes = $generalNotes;

        return new ServiceResponse(
            $specialInformation->save(),
            'Special information created',
            200,
            $specialInformation
        );
    }

    /**
     * @param int $employeeId
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
    ): ServiceResponse
    {
        $specialInformation = SpecialInformation::where('employee_id', $employeeId)->first();
        if ($specialInformation) {
            $specialInformation->city = $city;
            $specialInformation->current_office = $currentOffice;
            $specialInformation->address = $address;
            $specialInformation->working_status = $workingStatus;
            $specialInformation->general_status = $generalStatus;
            $specialInformation->general_equipment_status = $generalEquipmentStatus;
            $specialInformation->computer_status = $computerStatus;
            $specialInformation->internet_status = $internetStatus;
            $specialInformation->headphone_status = $headphoneStatus;
            $specialInformation->workable_date = $workableDate;
            $specialInformation->general_notes = $generalNotes;

            return new ServiceResponse(
                $specialInformation->save(),
                'Special information updated',
                200,
                $specialInformation
            );
        } else {
            return new ServiceResponse(
                false,
                'Special information not found',
                404,
                null
            );
        }
    }
}
