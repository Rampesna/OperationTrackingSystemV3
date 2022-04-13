<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\SurveySystemController\GetSurveyListRequest;
use App\Interfaces\OperationApi\ISurveySystemService;
use App\Traits\Response;

class SurveySystemController extends Controller
{
    use Response;

    private $personSystemService;

    public function __construct(ISurveySystemService $personSystemService)
    {
        $this->personSystemService = $personSystemService;
    }

    public function getSurveyList(GetSurveyListRequest $request)
    {
        return $this->success('Survey list', $this->personSystemService->GetSurveyList());
    }
}
