<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyPersonConnectRequest;
use App\Interfaces\OperationApi\ISurveySystemService;
use App\Traits\Response;

class SurveySystemController extends Controller
{
    use Response;

    private $surveySystemService;

    public function __construct(ISurveySystemService $surveySystemService)
    {
        $this->surveySystemService = $surveySystemService;
    }

    public function getSurveyList(GetSurveyListRequest $request)
    {
        return $this->success('Survey list', $this->surveySystemService->GetSurveyList());
    }

    public function setSurveyPersonConnect(SetSurveyPersonConnectRequest $request)
    {
        return $this->success('Employee surveys successfully set', $this->surveySystemService->SetSurveyPersonConnect(
            $request->surveyCode,
            $request->guids
        ));
    }
}
