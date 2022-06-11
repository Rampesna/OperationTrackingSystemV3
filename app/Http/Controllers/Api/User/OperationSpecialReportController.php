<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationSpecialReportController\GetSpecialReportRequest;
use App\Interfaces\OperationApi\ISpecialReportService;
use App\Traits\Response;

class OperationSpecialReportController extends Controller
{
    use Response;

    private $specialReportService;

    public function __construct(ISpecialReportService $specialReportService)
    {
        $this->specialReportService = $specialReportService;
    }

    public function getSpecialReport(GetSpecialReportRequest $request)
    {
        return $this->success('Special report', $this->specialReportService->GetSpecialReport(
            $request->startDate,
            $request->endDate,
            $request->input('query')
        ));
    }
}
