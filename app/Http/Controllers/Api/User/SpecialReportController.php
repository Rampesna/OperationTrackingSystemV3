<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\SpecialReportController\GetByCompanyIdRequest;
use App\Interfaces\Eloquent\ISpecialReportService;
use App\Traits\Response;

class SpecialReportController extends Controller
{
    use Response;

    private $specialReportService;

    public function __construct(ISpecialReportService $specialReportService)
    {
        $this->specialReportService = $specialReportService;
    }

    public function getByCompanyId(GetByCompanyIdRequest $request)
    {
        return $this->success('Special reports', $this->specialReportService->getByCompanyId($request->companyId));
    }
}
