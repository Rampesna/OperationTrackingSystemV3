<?php

namespace App\Http\Controllers\Api\Employee\OperationApi;

use App\Http\Controllers\Controller;
use App\Interfaces\OperationApi\IPersonReportService;
use App\Http\Requests\Api\Employee\OperationApi\PersonReportController\GetPersonPenaltiesRequest;
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
}
