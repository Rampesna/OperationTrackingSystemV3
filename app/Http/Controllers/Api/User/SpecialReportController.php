<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\SpecialReportController\GetByCompanyIdsRequest;
use App\Interfaces\Eloquent\ISpecialReportService;
use App\Traits\Response;

class SpecialReportController extends Controller
{
    use Response;

    /**
     * @var $specialReportService
     */
    private $specialReportService;

    /**
     * @param ISpecialReportService $specialReportService
     */
    public function __construct(ISpecialReportService $specialReportService)
    {
        $this->specialReportService = $specialReportService;
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $getByCompanyIdsResponse = $this->specialReportService->getByCompanyIds($request->companyIds);
        if ($getByCompanyIdsResponse->isSuccess()) {
            return $this->success(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getData(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByCompanyIdsResponse->getMessage(),
                $getByCompanyIdsResponse->getStatusCode()
            );
        }
    }
}
