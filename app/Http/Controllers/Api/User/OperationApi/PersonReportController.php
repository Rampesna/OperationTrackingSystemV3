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

    /**
     * @var $personReportService
     */
    private $personReportService;

    /**
     * @param IPersonReportService $personReportService
     */
    public function __construct(IPersonReportService $personReportService)
    {
        $this->personReportService = $personReportService;
    }

    /**
     * @param GetPersonAppointmentReportRequest $request
     */
    public function getPersonAppointmentReport(GetPersonAppointmentReportRequest $request)
    {
        $getPersonAppointmentReportResponse = $this->personReportService->GetPersonAppointmentReport(
            $request->companyIds
        );
        if ($getPersonAppointmentReportResponse->isSuccess()) {
            return $this->success(
                $getPersonAppointmentReportResponse->getMessage(),
                $getPersonAppointmentReportResponse->getData(),
                $getPersonAppointmentReportResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getPersonAppointmentReportResponse->getMessage(),
                $getPersonAppointmentReportResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetPersonnelAchievementRankingRequest $request
     */
    public function getPersonnelAchievementRanking(GetPersonnelAchievementRankingRequest $request)
    {
        $getPersonnelAchievementRankingResponse = $this->personReportService->GetPersonnelAchievementRanking(
            $request->employeeGuids
        );
        if ($getPersonnelAchievementRankingResponse->isSuccess()) {
            return $this->success(
                $getPersonnelAchievementRankingResponse->getMessage(),
                $getPersonnelAchievementRankingResponse->getData(),
                $getPersonnelAchievementRankingResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getPersonnelAchievementRankingResponse->getMessage(),
                $getPersonnelAchievementRankingResponse->getStatusCode()
            );
        }
    }
}
