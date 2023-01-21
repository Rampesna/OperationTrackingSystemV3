<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PrCardController\CreateRequest;
use App\Http\Requests\Api\User\PrCardController\GetByJobDepartmentIdRequest;
use \App\Http\Requests\Api\User\PrCardController\UpdateRequest;
use App\Interfaces\Eloquent\IPRCardService;
use App\Traits\Response;

class PrCardController extends Controller
{
    use Response;

    /**
     * @var $prCardService
     */
    private $prCardService;

    /**
     * @param IPRCardService $prCardService
     */
    public function __construct(IPRCardService $prCardService)
    {
        $this->prCardService = $prCardService;
    }

    /**
     * @param GetByJobDepartmentIdRequest $request
     */
    public function getByJobDepartmentId(GetByJobDepartmentIdRequest $request)
    {
        $getByJobDepartmentIdResponse = $this->prCardService->getByJobDepartmentId(
            $request->jobDepartmentId,
        );
        if ($getByJobDepartmentIdResponse->isSuccess()) {
            return $this->success(
                $getByJobDepartmentIdResponse->getMessage(),
                $getByJobDepartmentIdResponse->getData(),
                $getByJobDepartmentIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByJobDepartmentIdResponse->getMessage(),
                $getByJobDepartmentIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->prCardService->create(
            $request->name,
            $request->jobDepartmentId,
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
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->prCardService->update(
            $request->id,
            $request->name,
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

}
