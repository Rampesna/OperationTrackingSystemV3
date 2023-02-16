<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEarthquakeInformationService;
use App\Interfaces\Eloquent\IEloquentService;
use App\Models\Eloquent\EarthquakeInformation;
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
    ): ServiceResponse
    {
        $earthquakeInformation = new EarthquakeInformation;
        $earthquakeInformation->employee_id = $employeeId;
        $earthquakeInformation->city_id = $cityId;
        $earthquakeInformation->address = $address;
        $earthquakeInformation->home_status = $homeStatus;
        $earthquakeInformation->family_health_status = $familyHealthStatus;
        $earthquakeInformation->work_status = $workStatus;
        $earthquakeInformation->computer_status = $computerStatus;
        $earthquakeInformation->internet_status = $internetStatus;
        $earthquakeInformation->headphone_status = $headphoneStatus;
        $earthquakeInformation->save();

        return new ServiceResponse(
            true,
            'Earthquake information created',
            200,
            $earthquakeInformation
        );
    }

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
    ): ServiceResponse
    {
        $earthquakeInformation = $this->getByEmployeeId($employeeId);
        if ($earthquakeInformation->isSuccess()) {
            $earthquakeInformation = $earthquakeInformation->getData();
            $earthquakeInformation->employee_id = $employeeId;
            $earthquakeInformation->city_id = $cityId;
            $earthquakeInformation->address = $address;
            $earthquakeInformation->home_status = $homeStatus;
            $earthquakeInformation->family_health_status = $familyHealthStatus;
            $earthquakeInformation->work_status = $workStatus;
            $earthquakeInformation->computer_status = $computerStatus;
            $earthquakeInformation->internet_status = $internetStatus;
            $earthquakeInformation->headphone_status = $headphoneStatus;
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
