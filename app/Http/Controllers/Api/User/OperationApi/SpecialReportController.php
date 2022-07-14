<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\SpecialReportController\GetSpecialReportRequest;
use App\Interfaces\OperationApi\ISpecialReportService;
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
     * @param GetSpecialReportRequest $request
     */
    public function getSpecialReport(GetSpecialReportRequest $request)
    {
        $getSpecialReportResponse = $this->specialReportService->GetSpecialReport(
            $request->startDate,
            $request->endDate,
            $request->input('query')
        );
        if ($getSpecialReportResponse->isSuccess()) {
            return $this->success(
                $getSpecialReportResponse->getMessage(),
                $getSpecialReportResponse->getData(),
                $getSpecialReportResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSpecialReportResponse->getMessage(),
                $getSpecialReportResponse->getStatusCode()
            );
        }
    }
}
