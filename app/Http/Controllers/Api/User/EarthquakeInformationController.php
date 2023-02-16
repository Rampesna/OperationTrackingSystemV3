<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EarthquakeInformationController\GetAllRequest;
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
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $response = $this->earthquakeInformationService->getAll();
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
