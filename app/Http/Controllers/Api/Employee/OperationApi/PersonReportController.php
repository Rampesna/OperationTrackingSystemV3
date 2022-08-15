<?php

namespace App\Http\Controllers\Api\Employee\OperationApi;

use App\Http\Controllers\Controller;
use App\Interfaces\OperationApi\IPersonReportService;
use App\Http\Requests\Api\Employee\OperationApi\PersonReportController\GetPersonPenaltiesRequest;
use App\Http\Requests\Api\Employee\OperationApi\PersonReportController\GetAchievementPointsSingleDetailsRequest;
use App\Http\Requests\Api\Employee\OperationApi\PersonReportController\GetPersonPenaltiesDetailsRequest;
use App\Http\Requests\Api\Employee\OperationApi\PersonReportController\GetPersonnelAchievementRankingRequest;
use App\Models\Eloquent\Employee;
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
     * @param GetPersonPenaltiesRequest $request
     */
    public function getPersonPenalties(GetPersonPenaltiesRequest $request)
    {
        $getPersonPenaltiesResponse = $this->personReportService->GetPersonPenalties(
            $request->user()->guid
        );
        if ($getPersonPenaltiesResponse->isSuccess()) {
            return $this->success(
                $getPersonPenaltiesResponse->getMessage(),
                $getPersonPenaltiesResponse->getData(),
                $getPersonPenaltiesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getPersonPenaltiesResponse->getMessage(),
                $getPersonPenaltiesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetAchievementPointsSingleDetailsRequest $request
     */
    public function getAchievementPointsSingleDetails(GetAchievementPointsSingleDetailsRequest $request)
    {
        $GetAchievementPointsSingleDetailsResponse = $this->personReportService->GetAchievementPointsSingleDetails(
            $request->user()->guid
        );
        if ($GetAchievementPointsSingleDetailsResponse->isSuccess()) {
            return $this->success(
                $GetAchievementPointsSingleDetailsResponse->getMessage(),
                $GetAchievementPointsSingleDetailsResponse->getData(),
                $GetAchievementPointsSingleDetailsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $GetAchievementPointsSingleDetailsResponse->getMessage(),
                $GetAchievementPointsSingleDetailsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetPersonPenaltiesDetailsRequest $request
     */
    public function getPersonPenaltiesDetails(GetPersonPenaltiesDetailsRequest $request)
    {
        $getPersonPenaltiesDetailsResponse = $this->personReportService->GetPersonPenaltiesDetails(
            $request->user()->guid
        );
        if ($getPersonPenaltiesDetailsResponse->isSuccess()) {
            return $this->success(
                $getPersonPenaltiesDetailsResponse->getMessage(),
                $getPersonPenaltiesDetailsResponse->getData(),
                $getPersonPenaltiesDetailsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getPersonPenaltiesDetailsResponse->getMessage(),
                $getPersonPenaltiesDetailsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetPersonnelAchievementRankingRequest $request
     */
    public function getPersonnelAchievementRanking(GetPersonnelAchievementRankingRequest $request)
    {
        $getPersonnelAchievementRankingResponse = $this->personReportService->GetPersonnelAchievementRanking(
            Employee::where('guid', '<>', null)->where('leave', 0)->pluck('guid')->toArray()
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
