<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IRecruitingService;
use App\Http\Requests\Api\User\RecruitingController\GetByCompanyIdsRequest;
use App\Traits\Response;

class RecruitingController extends Controller
{
    use Response;

    /**
     * @var $recruitingService
     */
    private $recruitingService;

    /**
     * @param IRecruitingService $recruitingService
     */
    public function __construct(IRecruitingService $recruitingService)
    {
        $this->recruitingService = $recruitingService;
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $getAllResponse = $this->recruitingService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword,
            $request->departmentIds,
            $request->stepIds
        );
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
