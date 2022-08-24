<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IProjectLandingCustomerService;
use App\Http\Requests\Api\User\ProjectLandingCustomerController\GetAllByProjectIdRequest;
use App\Http\Requests\Api\User\ProjectLandingCustomerController\UpdateByProjectIdRequest;
use App\Traits\Response;

class ProjectLandingCustomerController extends Controller
{
    use Response;

    /**
     * @var $projectLandingCustomerService
     */
    private $projectLandingCustomerService;

    /**
     * @param IProjectLandingCustomerService $projectLandingCustomerService
     */
    public function __construct(IProjectLandingCustomerService $projectLandingCustomerService)
    {
        $this->projectLandingCustomerService = $projectLandingCustomerService;
    }

    /**
     * @param GetAllByProjectIdRequest $request
     */
    public function getAllByProjectId(GetAllByProjectIdRequest $request)
    {
        $getAllByProjectIdResponse = $this->projectLandingCustomerService->getAllByProjectId(
            $request->projectId
        );
        if ($getAllByProjectIdResponse->isSuccess()) {
            return $this->success(
                $getAllByProjectIdResponse->getMessage(),
                $getAllByProjectIdResponse->getData(),
                $getAllByProjectIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllByProjectIdResponse->getMessage(),
                $getAllByProjectIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateByProjectIdRequest $request
     */
    public function updateByProjectId(UpdateByProjectIdRequest $request)
    {
        $updateByProjectIdResponse = $this->projectLandingCustomerService->updateByProjectId(
            $request->projectId,
            $request->customerIds
        );
        if ($updateByProjectIdResponse->isSuccess()) {
            return $this->success(
                $updateByProjectIdResponse->getMessage(),
                $updateByProjectIdResponse->getData(),
                $updateByProjectIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateByProjectIdResponse->getMessage(),
                $updateByProjectIdResponse->getStatusCode()
            );
        }
    }
}
