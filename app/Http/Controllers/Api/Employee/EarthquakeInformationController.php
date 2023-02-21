<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EarthquakeInformationController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\Employee\EarthquakeInformationController\UpdateRequest;
use App\Interfaces\Eloquent\IEarthquakeInformationService;
use App\Traits\Response;

class EarthquakeInformationController extends Controller
{
    use Response;

    /**
     * @var $earthquakeInformationService
     */
    private $earthquakeInformationService;

    /**
     * @param IEarthquakeInformationService $earthquakeInformationService
     */
    public function __construct(IEarthquakeInformationService $earthquakeInformationService)
    {
        $this->earthquakeInformationService = $earthquakeInformationService;
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $response = $this->earthquakeInformationService->getByEmployeeId(
            $request->user()->id
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $response = $this->earthquakeInformationService->update(
            $request->user()->id,
            $request->city,
            $request->address,
            $request->homeStatus,
            $request->familyHealthStatus,
            $request->workingStatus,
            $request->workingAddress,
            $request->workingDepartment,
            $request->workableDate,
            $request->computerStatus,
            $request->internetStatus,
            $request->headphoneStatus,
            $request->generalNotes
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }
}
