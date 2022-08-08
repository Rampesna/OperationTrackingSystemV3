<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CentralMissionTypeController\GetAllRequest;
use App\Interfaces\Eloquent\ICentralMissionTypeService;
use App\Traits\Response;

class CentralMissionTypeController extends Controller
{
    use Response;

    /**
     * @var $centralMissionTypeService
     */
    private $centralMissionTypeService;

    /**
     * @param ICentralMissionTypeService $centralMissionTypeService
     */
    public function __construct(ICentralMissionTypeService $centralMissionTypeService)
    {
        $this->centralMissionTypeService = $centralMissionTypeService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->centralMissionTypeService->getAll();
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
