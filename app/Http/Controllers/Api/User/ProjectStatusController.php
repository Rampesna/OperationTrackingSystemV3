<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ProjectStatusController\GetAllRequest;
use App\Interfaces\Eloquent\IProjectStatusService;
use App\Traits\Response;

class ProjectStatusController extends Controller
{
    use Response;

    /**
     * @var $projectStatusService
     */
    private $projectStatusService;

    /**
     * @param IProjectStatusService $projectStatusService
     */
    public function __construct(IProjectStatusService $projectStatusService)
    {
        $this->projectStatusService = $projectStatusService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->projectStatusService->getAll();
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
