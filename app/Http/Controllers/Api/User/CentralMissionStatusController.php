<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CentralMissionStatusController\GetAllRequest;
use App\Interfaces\Eloquent\ICentralMissionStatusService;
use App\Traits\Response;

class CentralMissionStatusController extends Controller
{
    use Response;

    /**
     * @var $centralMissionStatusService
     */
    private $centralMissionStatusService;

    /**
     * @param ICentralMissionStatusService $centralMissionStatusService
     */
    public function __construct(ICentralMissionStatusService $centralMissionStatusService)
    {
        $this->centralMissionStatusService = $centralMissionStatusService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->centralMissionStatusService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }
}
