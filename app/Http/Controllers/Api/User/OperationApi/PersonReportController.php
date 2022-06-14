<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\PersonReportController\GetPersonAppointmentReportRequest;
use App\Http\Requests\Api\User\OperationApi\PersonReportController\GetPersonnelAchievementRankingRequest;
use App\Interfaces\OperationApi\IPersonReportService;
use App\Traits\Response;

class PersonReportController extends Controller
{
    use Response;

    private $personReportService;

    public function __construct(IPersonReportService $personReportService)
    {
        $this->personReportService = $personReportService;
    }

    public function getPersonAppointmentReport(GetPersonAppointmentReportRequest $request)
    {
        return $this->success('Person appointments', $this->personReportService->GetPersonAppointmentReport(
            $request->companyIds
        ));
    }

    public function getPersonnelAchievementRanking(GetPersonnelAchievementRankingRequest $request)
    {
        return $this->success('Personnel achievement ranking', $this->personReportService->GetPersonnelAchievementRanking(
            $request->employeeGuids
        ));
    }
}
