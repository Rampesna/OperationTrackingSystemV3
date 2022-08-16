<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IEmployeeQualityAssessmentService;
use App\Http\Requests\Api\User\EmployeeQualityAssessmentController\GetByUserIdRequest;
use App\Http\Requests\Api\User\EmployeeQualityAssessmentController\CreateRequest;
use App\Http\Requests\Api\User\EmployeeQualityAssessmentController\DeleteRequest;
use App\Traits\Response;

class EmployeeQualityAssessmentController extends Controller
{
    use Response;

    /**
     * @var $employeeQualityAssessmentService
     */
    private $employeeQualityAssessmentService;

    /**
     * @param IEmployeeQualityAssessmentService $employeeQualityAssessmentService
     */
    public function __construct(IEmployeeQualityAssessmentService $employeeQualityAssessmentService)
    {
        $this->employeeQualityAssessmentService = $employeeQualityAssessmentService;
    }

    /**
     * @param GetByUserIdRequest $request
     */
    public function getByUserId(GetByUserIdRequest $request)
    {
        $getByUserIdResponse = $this->employeeQualityAssessmentService->getByUserId(
            $request->user()->id,
            $request->qualityAssessmentTypeId,
            $request->pageIndex,
            $request->pageSize
        );
        if ($getByUserIdResponse->isSuccess()) {
            return $this->success(
                $getByUserIdResponse->getMessage(),
                $getByUserIdResponse->getData(),
                $getByUserIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByUserIdResponse->getMessage(),
                $getByUserIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->employeeQualityAssessmentService->create(
            $request->user()->id,
            $request->employeeId,
            $request->qualityAssessmentListId,
            $request->date,
            $request->callNumber,
            $request->callUrl,
            $request->parameters
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->employeeQualityAssessmentService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
