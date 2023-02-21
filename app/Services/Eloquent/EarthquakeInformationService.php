<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEarthquakeInformationService;
use App\Models\Eloquent\EarthquakeInformation;
use App\Models\Eloquent\Employee;
use App\Services\ServiceResponse;

class EarthquakeInformationService implements IEarthquakeInformationService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All earthquake informations',
            200,
            EarthquakeInformation::with([
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
        $earthquakeInformation = EarthquakeInformation::find($id);
        if ($earthquakeInformation) {
            return new ServiceResponse(
                true,
                'Earthquake information found',
                200,
                $earthquakeInformation
            );
        } else {
            return new ServiceResponse(
                false,
                'Earthquake information not found',
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
        $earthquakeInformation = $this->getById($id);
        if ($earthquakeInformation->isSuccess()) {
            return new ServiceResponse(
                $earthquakeInformation->getData()->delete(),
                'Earthquake information deleted',
                200,
                null
            );
        } else {
            return $earthquakeInformation;
        }
    }

    /**
     * @param int $employeeId
     */
    public function checkIfExists(
        int $employeeId
    ): ServiceResponse
    {
        $earthquakeInformation = EarthquakeInformation::where('employee_id', $employeeId)->first();
        if ($earthquakeInformation) {
            return new ServiceResponse(
                true,
                'Earthquake information exists',
                200,
                $earthquakeInformation
            );
        } else {
            return new ServiceResponse(
                false,
                'Earthquake information does not exist',
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
        $earthquakeInformations = EarthquakeInformation::with([
            'employee'
        ])->whereIn('employee_id', $employees->pluck('id')->toArray())->get();

        return new ServiceResponse(
            true,
            'Earthquake informations',
            200,
            $earthquakeInformations
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
        $earthquakeInformations = EarthquakeInformation::all();

        foreach ($employees as $employee) {
            $employeeEarthquakeInformation = $earthquakeInformations->where('employee_id', $employee->id)->first();
            if (!$employeeEarthquakeInformation) {
                $unregisteredEmployees->push($employee);
            } else if ($employeeEarthquakeInformation->city == '' || $employeeEarthquakeInformation->city == null) {
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
        $earthquakeInformation = EarthquakeInformation::where('employee_id', $employeeId)->first();
        if ($earthquakeInformation) {
            return new ServiceResponse(
                true,
                'Earthquake information',
                200,
                $earthquakeInformation
            );
        } else {
            $earthquakeInformation = new EarthquakeInformation;
            $earthquakeInformation->employee_id = $employeeId;
            $earthquakeInformation->save();

            return new ServiceResponse(
                true,
                'Earthquake information',
                200,
                $earthquakeInformation
            );
        }
    }

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
    ): ServiceResponse
    {
        $earthquakeInformation = $this->getByEmployeeId($employeeId);
        if ($earthquakeInformation->isSuccess()) {
            $earthquakeInformation = $earthquakeInformation->getData();
            $earthquakeInformation->city = $city;
            $earthquakeInformation->address = $address;
            $earthquakeInformation->home_status = $homeStatus;
            $earthquakeInformation->family_health_status = $familyHealthStatus;
            $earthquakeInformation->working_status = $workingStatus;
            $earthquakeInformation->working_address = $workingAddress;
            $earthquakeInformation->working_department = $workingDepartment;
            $earthquakeInformation->workable_date = $workableDate;
            $earthquakeInformation->computer_status = $computerStatus;
            $earthquakeInformation->internet_status = $internetStatus;
            $earthquakeInformation->headphone_status = $headphoneStatus;
            $earthquakeInformation->general_notes = $generalNotes;
            $earthquakeInformation->save();

            return new ServiceResponse(
                true,
                'Earthquake information created',
                200,
                $earthquakeInformation
            );
        } else {
            return $earthquakeInformation;
        }
    }

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
    ): ServiceResponse
    {
        $earthquakeInformation = $this->getByEmployeeId($employeeId);
        if ($earthquakeInformation->isSuccess()) {
            $earthquakeInformation = $earthquakeInformation->getData();
            $earthquakeInformation->city = $city;
            $earthquakeInformation->address = $address;
            $earthquakeInformation->home_status = $homeStatus;
            $earthquakeInformation->family_health_status = $familyHealthStatus;
            $earthquakeInformation->working_status = $workingStatus;
            $earthquakeInformation->working_address = $workingAddress;
            $earthquakeInformation->working_department = $workingDepartment;
            $earthquakeInformation->workable_date = $workableDate;
            $earthquakeInformation->computer_status = $computerStatus;
            $earthquakeInformation->internet_status = $internetStatus;
            $earthquakeInformation->headphone_status = $headphoneStatus;
            $earthquakeInformation->general_notes = $generalNotes;
            $earthquakeInformation->save();

            return new ServiceResponse(
                true,
                'Earthquake information updated',
                200,
                $earthquakeInformation
            );
        } else {
            return $earthquakeInformation;
        }
    }
}
