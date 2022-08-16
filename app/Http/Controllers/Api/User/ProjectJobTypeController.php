<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ProjectJobTypeController\GetAllRequest;
use App\Interfaces\Eloquent\IProjectJobTypeService;
use App\Traits\Response;

class ProjectJobTypeController extends Controller
{
    use Response;

    /**
     * @var $projectJobTypeService
     */
    private $projectJobTypeService;

    /**
     * @param IProjectJobTypeService $projectJobTypeService
     */
    public function __construct(IProjectJobTypeService $projectJobTypeService)
    {
        $this->projectJobTypeService = $projectJobTypeService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->projectJobTypeService->getAll();
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
