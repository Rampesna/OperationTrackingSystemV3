<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyPersonConnectRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyEditRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyGroupConnectRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyQuestionsListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyAnswersListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyQuestionEditRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyProductListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyAnswerEditRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyAnswersCategoryConnectListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyAnswersConnectListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyAnswersProductConnectListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyQuestionsRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyQuestionsDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyAnswersRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyAnswersCategoryConnectRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyAnswersConnectRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyAnswersProductConnectRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyAnswersDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyReportRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyReportWantedDetailsRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyReportRemainingDetailsRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyReportStatusDetailsRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyDetailReportRequest;
use App\Interfaces\OperationApi\ISurveySystemService;
use App\Traits\Response;
use Maatwebsite\Excel\Facades\Excel;

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

    public function setSurvey(SetSurveyRequest $request)
    {
        return $this->success('Survey', $this->surveySystemService->SetSurvey(
            $request->id ? intval($request->id) : null,
            intval($request->code),
            $request->name,
            $request->description,
            $request->customerInformation1,
            $request->customerInformation2,
            $request->serviceProduct,
            $request->callReason,
            intval($request->opportunity),
            intval($request->call),
            intval($request->dialPlan),
            intval($request->opportunityRedirectToSeller),
            intval($request->dialPlanRedirectToSeller),
            intval($request->additionalProductOpportunity),
            intval($request->additionalProductCallPlan),
            intval($request->sellerRedirectionType),
            $request->emailTitle,
            $request->emailContent,
            $request->jobResource,
            $request->listCode,
            $request->status,
            $request->file('callList') ? Excel::toCollection(null, $request->file('callList'))->map(function ($row) {
                return [
                    'cariId' => $row[0],
                ];
            })->toArray() : []
        ));
    }

    public function getSurveyEdit(GetSurveyEditRequest $request)
    {
        return $this->success('Survey', $this->surveySystemService->GetSurveyEdit(
            $request->id
        ));
    }

    public function setSurveyDelete(SetSurveyDeleteRequest $request)
    {
        return $this->success('Survey deleted', $this->surveySystemService->setSurveyDelete(
            $request->id
        ));
    }

    public function setSurveyGroupConnect(SetSurveyGroupConnectRequest $request)
    {
        return $this->success('Survey group connected', $this->surveySystemService->setSurveyGroupConnect(
            $request->surveyCode,
            $request->subSurveyCode
        ));
    }

    public function getSurveyQuestionsList(GetSurveyQuestionsListRequest $request)
    {
        return $this->success('Survey questions list', $this->surveySystemService->GetSurveyQuestionsList(
            $request->surveyCode
        ));
    }

    public function getSurveyAnswersList(GetSurveyAnswersListRequest $request)
    {
        return $this->success('Survey question answers list', $this->surveySystemService->GetSurveyAnswersList(
            $request->questionId
        ));
    }

    public function getSurveyQuestionEdit(GetSurveyQuestionEditRequest $request)
    {
        return $this->success('Survey question', $this->surveySystemService->GetSurveyQuestionEdit(
            $request->questionId
        ));
    }

    public function getSurveyProductList(GetSurveyProductListRequest $request)
    {
        return $this->success('Product list', $this->surveySystemService->GetSurveyProductList());
    }

    public function getSurveyAnswerEdit(GetSurveyAnswerEditRequest $request)
    {
        return $this->success('Answer', $this->surveySystemService->GetSurveyAnswerEdit(
            $request->answerId
        ));
    }

    public function getSurveyAnswersCategoryConnectList(GetSurveyAnswersCategoryConnectListRequest $request)
    {
        return $this->success('Answer category connect list', $this->surveySystemService->GetSurveyAnswersCategoryConnectList(
            $request->answerId
        ));
    }

    public function getSurveyAnswersConnectList(GetSurveyAnswersConnectListRequest $request)
    {
        return $this->success('Answer connect list', $this->surveySystemService->GetSurveyAnswersConnectList(
            $request->answerId
        ));
    }

    public function getSurveyAnswersProductConnectList(GetSurveyAnswersProductConnectListRequest $request)
    {
        return $this->success('Answer product connect list', $this->surveySystemService->GetSurveyAnswersProductConnectList(
            $request->answerId
        ));
    }

    public function setSurveyQuestions(SetSurveyQuestionsRequest $request)
    {
        return $this->success('Set survey question', $this->surveySystemService->SetSurveyQuestions(
            $request->id,
            $request->question,
            $request->typeId,
            $request->additionalQuestion,
            $request->order,
            $request->surveyCode,
            $request->description,
            $request->required
        ));
    }

    public function setSurveyQuestionsDelete(SetSurveyQuestionsDeleteRequest $request)
    {
        return $this->success('Survey question deleted', $this->surveySystemService->SetSurveyQuestionsDelete(
            $request->questionId
        ));
    }

    public function setSurveyAnswers(SetSurveyAnswersRequest $request)
    {
        return $this->success('Answer', $this->surveySystemService->SetSurveyAnswers(
            $request->id,
            $request->questionId,
            $request->answer,
            $request->order,
            $request->columns
        ));
    }

    public function setSurveyAnswersCategoryConnect(SetSurveyAnswersCategoryConnectRequest $request)
    {
        return $this->success('Answer categories connected', $this->surveySystemService->SetSurveyAnswersCategoryConnect(
            $request->categories
        ));
    }

    public function setSurveyAnswersConnect(SetSurveyAnswersConnectRequest $request)
    {
        return $this->success('Answer questions connected', $this->surveySystemService->SetSurveyAnswersConnect(
            $request->questions
        ));
    }

    public function setSurveyAnswersProductConnect(SetSurveyAnswersProductConnectRequest $request)
    {
        return $this->success('Answer products connected', $this->surveySystemService->SetSurveyAnswersProductConnect(
            $request->products
        ));
    }

    public function setSurveyAnswersDelete(SetSurveyAnswersDeleteRequest $request)
    {
        return $this->success('Answer deleted', $this->surveySystemService->SetSurveyAnswersDelete(
            $request->answerId
        ));
    }

    public function getSurveyReport(GetSurveyReportRequest $request)
    {
        return $this->success('Survey report', $this->surveySystemService->GetSurveyReport(
            $request->surveyCode,
            $request->startDate,
            $request->endDate,
            $request->companyIds
        ));
    }

    public function getSurveyReportWantedDetails(GetSurveyReportWantedDetailsRequest $request)
    {
        return $this->success('Survey wanted report', $this->surveySystemService->GetSurveyReportWantedDetails(
            $request->surveyCode
        ));
    }

    public function getSurveyReportRemainingDetails(GetSurveyReportRemainingDetailsRequest $request)
    {
        return $this->success('Survey remaining report', $this->surveySystemService->GetSurveyReportRemainingDetails(
            $request->surveyCode,
            $request->startDate,
            $request->endDate
        ));
    }

    public function getSurveyReportStatusDetails(GetSurveyReportStatusDetailsRequest $request)
    {
        return $this->success('Survey status report', $this->surveySystemService->GetSurveyReportStatusDetails(
            $request->surveyCode,
            $request->startDate,
            $request->endDate,
            $request->statusCodes
        ));
    }

    public function getSurveyDetailReport(GetSurveyDetailReportRequest $request)
    {
        return $this->success('Survey status report', $this->surveySystemService->GetSurveyDetailReport(
            $request->surveyCode,
            $request->startDate,
            $request->endDate,
            $request->companyIds
        ));
    }

    public function getSurveyDetailReportGroupById(GetSurveyDetailReportRequest $request)
    {
        return $this->success('Survey status report', collect(
            $this->surveySystemService->GetSurveyDetailReport(
                $request->surveyCode,
                $request->startDate,
                $request->endDate,
                $request->companyIds
            )
        )->groupBy('id')->all());
    }
}
