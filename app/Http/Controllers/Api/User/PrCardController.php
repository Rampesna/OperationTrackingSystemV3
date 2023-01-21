<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PrCardController\GetByJobDepartmentIdRequest;
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
}
