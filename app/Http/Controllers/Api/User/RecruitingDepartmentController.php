<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\RecruitingDepartmentController\GetAllRequest;
use App\Interfaces\Eloquent\IRecruitingDepartmentService;
use App\Traits\Response;

class RecruitingDepartmentController extends Controller
{
    use Response;

    /**
     * @var $recruitingDepartmentService
     */
    private $recruitingDepartmentService;

    /**
     * @param IRecruitingDepartmentService $recruitingDepartmentService
     */
    public function __construct(IRecruitingDepartmentService $recruitingDepartmentService)
    {
        $this->recruitingDepartmentService = $recruitingDepartmentService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->recruitingDepartmentService->getAll();
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
