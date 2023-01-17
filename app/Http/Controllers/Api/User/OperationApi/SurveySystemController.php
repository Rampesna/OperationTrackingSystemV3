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
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyProductEditRequest;
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
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveySellerListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveySellerConnectRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveySellerDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyProductRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\CopySurveyRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyCategoryListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyCategoryRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyCategoryEditRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyCategoryDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyOpponentListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyOpponentRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyOpponentEditRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyOpponentDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveySoftwareListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveySoftwareRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveySoftwareEditRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveySoftwareDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyIntegratorListRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyIntegratorRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\GetSurveyIntegratorEditRequest;
use App\Http\Requests\Api\User\OperationApi\SurveySystemController\SetSurveyIntegratorDeleteRequest;
use App\Interfaces\OperationApi\ISurveySystemService;
use App\Traits\Response;
use Maatwebsite\Excel\Facades\Excel;

class SurveySystemController extends Controller
{
    use Response;

    /**
     * @var $surveySystemService
     */
    private $surveySystemService;

    /**
     * @param ISurveySystemService $surveySystemService
     */
    public function __construct(ISurveySystemService $surveySystemService)
    {
        set_time_limit(86400);
        $this->surveySystemService = $surveySystemService;
    }

    /**
     * @param GetSurveyListRequest $request
     */
    public function getSurveyList(GetSurveyListRequest $request)
    {
        $getSurveyListResponse = $this->surveySystemService->GetSurveyList();
        if ($getSurveyListResponse->isSuccess()) {
            return $this->success(
                $getSurveyListResponse->getMessage(),
                $getSurveyListResponse->getData(),
                $getSurveyListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyListResponse->getMessage(),
                $getSurveyListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyPersonConnectRequest $request
     */
    public function setSurveyPersonConnect(SetSurveyPersonConnectRequest $request)
    {
        $setSurveyPersonConnectResponse = $this->surveySystemService->SetSurveyPersonConnect(
            $request->surveyCode,
            $request->guids
        );
        if ($setSurveyPersonConnectResponse->isSuccess()) {
            return $this->success(
                $setSurveyPersonConnectResponse->getMessage(),
                $setSurveyPersonConnectResponse->getData(),
                $setSurveyPersonConnectResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyPersonConnectResponse->getMessage(),
                $setSurveyPersonConnectResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyRequest $request
     */
    public function setSurvey(SetSurveyRequest $request)
    {
        $callListFromFile = $request->file('callList') ? Excel::toCollection(null, $request->file('callList'))[0] : [];
        $callList = [];
        foreach ($callListFromFile as $key => $value) {
            if (gettype($value[0]) == 'integer') {
                $callList[] = [
                    'cariId' => $value[0],
                ];
            }
        }
        $setSurveyResponse = $this->surveySystemService->SetSurvey(
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
            $request->isNewMarketingScreen,
            $request->isSurvey,
            $request->cantCallGroupCode,
            $request->descriptionHtml,
            $callList
        );
        if ($setSurveyResponse->isSuccess()) {
            return $this->success(
                $setSurveyResponse->getMessage(),
                $setSurveyResponse->getData(),
                $setSurveyResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyResponse->getMessage(),
                $setSurveyResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyEditRequest $request
     */
    public function getSurveyEdit(GetSurveyEditRequest $request)
    {
        $getSurveyEditResponse = $this->surveySystemService->GetSurveyEdit(
            $request->id
        );
        if ($getSurveyEditResponse->isSuccess()) {
            return $this->success(
                $getSurveyEditResponse->getMessage(),
                $getSurveyEditResponse->getData(),
                $getSurveyEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyEditResponse->getMessage(),
                $getSurveyEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyDeleteRequest $request
     */
    public function setSurveyDelete(SetSurveyDeleteRequest $request)
    {
        $setSurveyDeleteResponse = $this->surveySystemService->setSurveyDelete(
            $request->id
        );
        if ($setSurveyDeleteResponse->isSuccess()) {
            return $this->success(
                $setSurveyDeleteResponse->getMessage(),
                $setSurveyDeleteResponse->getData(),
                $setSurveyDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyDeleteResponse->getMessage(),
                $setSurveyDeleteResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyGroupConnectRequest $request
     */
    public function setSurveyGroupConnect(SetSurveyGroupConnectRequest $request)
    {
        $setSurveyGroupConnectResponse = $this->surveySystemService->setSurveyGroupConnect(
            $request->surveyCode,
            $request->subSurveyCode
        );
        if ($setSurveyGroupConnectResponse->isSuccess()) {
            return $this->success(
                $setSurveyGroupConnectResponse->getMessage(),
                $setSurveyGroupConnectResponse->getData(),
                $setSurveyGroupConnectResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyGroupConnectResponse->getMessage(),
                $setSurveyGroupConnectResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyQuestionsListRequest $request
     */
    public function getSurveyQuestionsList(GetSurveyQuestionsListRequest $request)
    {
        $getSurveyQuestionsListResponse = $this->surveySystemService->GetSurveyQuestionsList(
            $request->surveyCode
        );
        if ($getSurveyQuestionsListResponse->isSuccess()) {
            return $this->success(
                $getSurveyQuestionsListResponse->getMessage(),
                $getSurveyQuestionsListResponse->getData(),
                $getSurveyQuestionsListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyQuestionsListResponse->getMessage(),
                $getSurveyQuestionsListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyAnswersListRequest $request
     */
    public function getSurveyAnswersList(GetSurveyAnswersListRequest $request)
    {
        $getSurveyAnswersListResponse = $this->surveySystemService->GetSurveyAnswersList(
            $request->questionId
        );
        if ($getSurveyAnswersListResponse->isSuccess()) {
            return $this->success(
                $getSurveyAnswersListResponse->getMessage(),
                $getSurveyAnswersListResponse->getData(),
                $getSurveyAnswersListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyAnswersListResponse->getMessage(),
                $getSurveyAnswersListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyQuestionEditRequest $request
     */
    public function getSurveyQuestionEdit(GetSurveyQuestionEditRequest $request)
    {
        $getSurveyQuestionEditResponse = $this->surveySystemService->GetSurveyQuestionEdit(
            $request->questionId
        );
        if ($getSurveyQuestionEditResponse->isSuccess()) {
            return $this->success(
                $getSurveyQuestionEditResponse->getMessage(),
                $getSurveyQuestionEditResponse->getData(),
                $getSurveyQuestionEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyQuestionEditResponse->getMessage(),
                $getSurveyQuestionEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyProductListRequest $request
     */
    public function getSurveyProductList(GetSurveyProductListRequest $request)
    {
        $getSurveyProductListResponse = $this->surveySystemService->GetSurveyProductList();
        if ($getSurveyProductListResponse->isSuccess()) {
            return $this->success(
                $getSurveyProductListResponse->getMessage(),
                $getSurveyProductListResponse->getData(),
                $getSurveyProductListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyProductListResponse->getMessage(),
                $getSurveyProductListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyProductEditRequest $request
     */
    public function getSurveyProductEdit(GetSurveyProductEditRequest $request)
    {
        $getSurveyProductEditResponse = $this->surveySystemService->GetSurveyProductEdit(
            $request->productId
        );
        if ($getSurveyProductEditResponse->isSuccess()) {
            return $this->success(
                $getSurveyProductEditResponse->getMessage(),
                $getSurveyProductEditResponse->getData(),
                $getSurveyProductEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyProductEditResponse->getMessage(),
                $getSurveyProductEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyAnswerEditRequest $request
     */
    public function getSurveyAnswerEdit(GetSurveyAnswerEditRequest $request)
    {
        $getSurveyAnswerEditResponse = $this->surveySystemService->GetSurveyAnswerEdit(
            $request->answerId
        );
        if ($getSurveyAnswerEditResponse->isSuccess()) {
            return $this->success(
                $getSurveyAnswerEditResponse->getMessage(),
                $getSurveyAnswerEditResponse->getData(),
                $getSurveyAnswerEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyAnswerEditResponse->getMessage(),
                $getSurveyAnswerEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyAnswersCategoryConnectListRequest $request
     */
    public function getSurveyAnswersCategoryConnectList(GetSurveyAnswersCategoryConnectListRequest $request)
    {
        $getSurveyAnswersCategoryConnectListResponse = $this->surveySystemService->GetSurveyAnswersCategoryConnectList(
            $request->answerId
        );
        if ($getSurveyAnswersCategoryConnectListResponse->isSuccess()) {
            return $this->success(
                $getSurveyAnswersCategoryConnectListResponse->getMessage(),
                $getSurveyAnswersCategoryConnectListResponse->getData(),
                $getSurveyAnswersCategoryConnectListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyAnswersCategoryConnectListResponse->getMessage(),
                $getSurveyAnswersCategoryConnectListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyAnswersConnectListRequest $request
     */
    public function getSurveyAnswersConnectList(GetSurveyAnswersConnectListRequest $request)
    {
        $getSurveyAnswersConnectListResponse = $this->surveySystemService->GetSurveyAnswersConnectList(
            $request->answerId
        );
        if ($getSurveyAnswersConnectListResponse->isSuccess()) {
            return $this->success(
                $getSurveyAnswersConnectListResponse->getMessage(),
                $getSurveyAnswersConnectListResponse->getData(),
                $getSurveyAnswersConnectListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyAnswersConnectListResponse->getMessage(),
                $getSurveyAnswersConnectListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyAnswersProductConnectListRequest $request
     */
    public function getSurveyAnswersProductConnectList(GetSurveyAnswersProductConnectListRequest $request)
    {
        $getSurveyAnswersProductConnectListResponse = $this->surveySystemService->GetSurveyAnswersProductConnectList(
            $request->answerId
        );
        if ($getSurveyAnswersProductConnectListResponse->isSuccess()) {
            return $this->success(
                $getSurveyAnswersProductConnectListResponse->getMessage(),
                $getSurveyAnswersProductConnectListResponse->getData(),
                $getSurveyAnswersProductConnectListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyAnswersProductConnectListResponse->getMessage(),
                $getSurveyAnswersProductConnectListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyQuestionsRequest $request
     */
    public function setSurveyQuestions(SetSurveyQuestionsRequest $request)
    {
        $setSurveyQuestionsResponse = $this->surveySystemService->SetSurveyQuestions(
            $request->id,
            $request->question,
            $request->typeId,
            $request->additionalQuestion,
            $request->order,
            $request->surveyCode,
            $request->description,
            $request->required
        );
        if ($setSurveyQuestionsResponse->isSuccess()) {
            return $this->success(
                $setSurveyQuestionsResponse->getMessage(),
                $setSurveyQuestionsResponse->getData(),
                $setSurveyQuestionsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyQuestionsResponse->getMessage(),
                $setSurveyQuestionsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyQuestionsDeleteRequest $request
     */
    public function setSurveyQuestionsDelete(SetSurveyQuestionsDeleteRequest $request)
    {
        $setSurveyQuestionsDeleteResponse = $this->surveySystemService->SetSurveyQuestionsDelete(
            $request->questionId
        );
        if ($setSurveyQuestionsDeleteResponse->isSuccess()) {
            return $this->success(
                $setSurveyQuestionsDeleteResponse->getMessage(),
                $setSurveyQuestionsDeleteResponse->getData(),
                $setSurveyQuestionsDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyQuestionsDeleteResponse->getMessage(),
                $setSurveyQuestionsDeleteResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyAnswersRequest $request
     */
    public function setSurveyAnswers(SetSurveyAnswersRequest $request)
    {
        $setSurveyAnswersResponse = $this->surveySystemService->SetSurveyAnswers(
            $request->id,
            $request->questionId,
            $request->answer,
            $request->order,
            $request->columns ?? ''
        );
        if ($setSurveyAnswersResponse->isSuccess()) {
            return $this->success(
                $setSurveyAnswersResponse->getMessage(),
                $setSurveyAnswersResponse->getData(),
                $setSurveyAnswersResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyAnswersResponse->getMessage(),
                $setSurveyAnswersResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyAnswersCategoryConnectRequest $request
     */
    public function setSurveyAnswersCategoryConnect(SetSurveyAnswersCategoryConnectRequest $request)
    {
        $setSurveyAnswersCategoryConnectResponse = $this->surveySystemService->SetSurveyAnswersCategoryConnect(
            $request->categories ?? []
        );
        if ($setSurveyAnswersCategoryConnectResponse->isSuccess()) {
            return $this->success(
                $setSurveyAnswersCategoryConnectResponse->getMessage(),
                $setSurveyAnswersCategoryConnectResponse->getData(),
                $setSurveyAnswersCategoryConnectResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyAnswersCategoryConnectResponse->getMessage(),
                $setSurveyAnswersCategoryConnectResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyAnswersConnectRequest $request
     */
    public function setSurveyAnswersConnect(SetSurveyAnswersConnectRequest $request)
    {
        $setSurveyAnswersConnectResponse = $this->surveySystemService->SetSurveyAnswersConnect(
            $request->questions ?? []
        );
        if ($setSurveyAnswersConnectResponse->isSuccess()) {
            return $this->success(
                $setSurveyAnswersConnectResponse->getMessage(),
                $setSurveyAnswersConnectResponse->getData(),
                $setSurveyAnswersConnectResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyAnswersConnectResponse->getMessage(),
                $setSurveyAnswersConnectResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyAnswersProductConnectRequest $request
     */
    public function setSurveyAnswersProductConnect(SetSurveyAnswersProductConnectRequest $request)
    {
        $setSurveyAnswersProductConnectResponse = $this->surveySystemService->SetSurveyAnswersProductConnect(
            $request->products ?? []
        );
        if ($setSurveyAnswersProductConnectResponse->isSuccess()) {
            return $this->success(
                $setSurveyAnswersProductConnectResponse->getMessage(),
                $setSurveyAnswersProductConnectResponse->getData(),
                $setSurveyAnswersProductConnectResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyAnswersProductConnectResponse->getMessage(),
                $setSurveyAnswersProductConnectResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyAnswersDeleteRequest $request
     */
    public function setSurveyAnswersDelete(SetSurveyAnswersDeleteRequest $request)
    {
        $setSurveyAnswersDeleteResponse = $this->surveySystemService->SetSurveyAnswersDelete(
            $request->answerId
        );
        if ($setSurveyAnswersDeleteResponse->isSuccess()) {
            return $this->success(
                $setSurveyAnswersDeleteResponse->getMessage(),
                $setSurveyAnswersDeleteResponse->getData(),
                $setSurveyAnswersDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyAnswersDeleteResponse->getMessage(),
                $setSurveyAnswersDeleteResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyReportRequest $request
     */
    public function getSurveyReport(GetSurveyReportRequest $request)
    {
        $getSurveyReportResponse = $this->surveySystemService->GetSurveyReport(
            $request->surveyCode,
            $request->startDate,
            $request->endDate,
            $request->companyIds
        );
        if ($getSurveyReportResponse->isSuccess()) {
            return $this->success(
                $getSurveyReportResponse->getMessage(),
                $getSurveyReportResponse->getData(),
                $getSurveyReportResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyReportResponse->getMessage(),
                $getSurveyReportResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyReportWantedDetailsRequest $request
     */
    public function getSurveyReportWantedDetails(GetSurveyReportWantedDetailsRequest $request)
    {
        $getSurveyReportWantedDetailsResponse = $this->surveySystemService->GetSurveyReportWantedDetails(
            $request->surveyCode
        );
        if ($getSurveyReportWantedDetailsResponse->isSuccess()) {
            return $this->success(
                $getSurveyReportWantedDetailsResponse->getMessage(),
                $getSurveyReportWantedDetailsResponse->getData(),
                $getSurveyReportWantedDetailsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyReportWantedDetailsResponse->getMessage(),
                $getSurveyReportWantedDetailsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyReportRemainingDetailsRequest $request
     */
    public function getSurveyReportRemainingDetails(GetSurveyReportRemainingDetailsRequest $request)
    {
        $getSurveyReportRemainingDetailsResponse = $this->surveySystemService->GetSurveyReportRemainingDetails(
            $request->surveyCode,
            $request->startDate,
            $request->endDate
        );
        if ($getSurveyReportRemainingDetailsResponse->isSuccess()) {
            return $this->success(
                $getSurveyReportRemainingDetailsResponse->getMessage(),
                $getSurveyReportRemainingDetailsResponse->getData(),
                $getSurveyReportRemainingDetailsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyReportRemainingDetailsResponse->getMessage(),
                $getSurveyReportRemainingDetailsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyReportStatusDetailsRequest $request
     */
    public function getSurveyReportStatusDetails(GetSurveyReportStatusDetailsRequest $request)
    {
        $getSurveyReportStatusDetailsResponse = $this->surveySystemService->GetSurveyReportStatusDetails(
            $request->surveyCode,
            $request->startDate,
            $request->endDate,
            $request->statusCodes
        );
        if ($getSurveyReportStatusDetailsResponse->isSuccess()) {
            return $this->success(
                $getSurveyReportStatusDetailsResponse->getMessage(),
                $getSurveyReportStatusDetailsResponse->getData(),
                $getSurveyReportStatusDetailsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyReportStatusDetailsResponse->getMessage(),
                $getSurveyReportStatusDetailsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyDetailReportRequest $request
     */
    public function getSurveyDetailReport(GetSurveyDetailReportRequest $request)
    {
        $getSurveyDetailReportResponse = $this->surveySystemService->GetSurveyDetailReport(
            $request->surveyCode,
            $request->startDate,
            $request->endDate,
            $request->companyIds
        );
        if ($getSurveyDetailReportResponse->isSuccess()) {
            return $this->success(
                $getSurveyDetailReportResponse->getMessage(),
                $getSurveyDetailReportResponse->getData(),
                $getSurveyDetailReportResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyDetailReportResponse->getMessage(),
                $getSurveyDetailReportResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyDetailReportRequest $request
     */
    public function getSurveyDetailReportGroupById(GetSurveyDetailReportRequest $request)
    {
        $getSurveyDetailReportResponse = $this->surveySystemService->GetSurveyDetailReport(
            $request->surveyCode,
            $request->startDate,
            $request->endDate,
            $request->companyIds
        );
        if ($getSurveyDetailReportResponse->isSuccess()) {
            return $this->success(
                $getSurveyDetailReportResponse->getMessage(),
                collect($getSurveyDetailReportResponse->getData())->groupBy('id')->all(),
                $getSurveyDetailReportResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyDetailReportResponse->getMessage(),
                $getSurveyDetailReportResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveySellerListRequest $request
     */
    public function getSurveySellerList(GetSurveySellerListRequest $request)
    {
        $getSurveySellerListResponse = $this->surveySystemService->GetSurveySellerList();
        if ($getSurveySellerListResponse->isSuccess()) {
            return $this->success(
                $getSurveySellerListResponse->getMessage(),
                $getSurveySellerListResponse->getData(),
                $getSurveySellerListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveySellerListResponse->getMessage(),
                $getSurveySellerListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveySellerConnectRequest $request
     */
    public function setSurveySellerConnect(SetSurveySellerConnectRequest $request)
    {
        $setSurveySellerConnectResponse = $this->surveySystemService->SetSurveySellerConnect(
            $request->sellers,
            $request->surveys,
            $request->products
        );
        if ($setSurveySellerConnectResponse->isSuccess()) {
            return $this->success(
                $setSurveySellerConnectResponse->getMessage(),
                $setSurveySellerConnectResponse->getData(),
                $setSurveySellerConnectResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveySellerConnectResponse->getMessage(),
                $setSurveySellerConnectResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveySellerDeleteRequest $request
     */
    public function setSurveySellerDelete(SetSurveySellerDeleteRequest $request)
    {
        $setSurveySellerDeleteResponse = $this->surveySystemService->setSurveySellerDelete(
            $request->sellerId
        );
        if ($setSurveySellerDeleteResponse->isSuccess()) {
            return $this->success(
                $setSurveySellerDeleteResponse->getMessage(),
                $setSurveySellerDeleteResponse->getData(),
                $setSurveySellerDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveySellerDeleteResponse->getMessage(),
                $setSurveySellerDeleteResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyProductRequest $request
     */
    public function setSurveyProduct(SetSurveyProductRequest $request)
    {
        $products = [
            [
                'id' => $request->id,
                'kodu' => $request->kodu,
                'adi' => $request->adi,
                'durum' => $request->durum,
                'epostaBaslik' => $request->epostaBaslik ?? '',
                'epostaIcerik' => $request->hasFile('epostaIcerik') ? file_get_contents($request->file('epostaIcerik')) : '',
            ]
        ];
        $setSurveyProductResponse = $this->surveySystemService->SetSurveyProduct(
            $products
        );
        if ($setSurveyProductResponse->isSuccess()) {
            return $this->success(
                $setSurveyProductResponse->getMessage(),
                $setSurveyProductResponse->getData(),
                $setSurveyProductResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyProductResponse->getMessage(),
                $setSurveyProductResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CopySurveyRequest $request
     */
    public function copySurvey(CopySurveyRequest $request)
    {
        $copySurveyResponse = $this->surveySystemService->copySurvey(
            $request->surveyId,
            $request->surveyCode,
            $request->name
        );
        if ($copySurveyResponse->isSuccess()) {
            return $this->success(
                $copySurveyResponse->getMessage(),
                $copySurveyResponse->getData(),
                $copySurveyResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $copySurveyResponse->getMessage(),
                $copySurveyResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyCategoryListRequest $request
     */
    public function getSurveyCategoryList(GetSurveyCategoryListRequest $request)
    {
        $getSurveyCategoryListResponse = $this->surveySystemService->GetSurveyCategoryList();
        if ($getSurveyCategoryListResponse->isSuccess()) {
            return $this->success(
                $getSurveyCategoryListResponse->getMessage(),
                $getSurveyCategoryListResponse->getData(),
                $getSurveyCategoryListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyCategoryListResponse->getMessage(),
                $getSurveyCategoryListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyCategoryRequest $request
     */
    public function setSurveyCategory(SetSurveyCategoryRequest $request)
    {
        $setSurveyCategoryResponse = $this->surveySystemService->SetSurveyCategory(
            $request->id,
            $request->code,
            $request->name,
            $request->typeCode,
            $request->status
        );
        if ($setSurveyCategoryResponse->isSuccess()) {
            return $this->success(
                $setSurveyCategoryResponse->getMessage(),
                $setSurveyCategoryResponse->getData(),
                $setSurveyCategoryResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyCategoryResponse->getMessage(),
                $setSurveyCategoryResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyCategoryEditRequest $request
     */
    public function getSurveyCategoryEdit(GetSurveyCategoryEditRequest $request)
    {
        $getSurveyCategoryEditResponse = $this->surveySystemService->GetSurveyCategoryEdit(
            $request->categoryId
        );
        if ($getSurveyCategoryEditResponse->isSuccess()) {
            return $this->success(
                $getSurveyCategoryEditResponse->getMessage(),
                $getSurveyCategoryEditResponse->getData(),
                $getSurveyCategoryEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyCategoryEditResponse->getMessage(),
                $getSurveyCategoryEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyCategoryDeleteRequest $request
     */
    public function setSurveyCategoryDelete(SetSurveyCategoryDeleteRequest $request)
    {
        $setSurveyCategoryDeleteResponse = $this->surveySystemService->SetSurveyCategoryDelete(
            $request->categoryId
        );
        if ($setSurveyCategoryDeleteResponse->isSuccess()) {
            return $this->success(
                $setSurveyCategoryDeleteResponse->getMessage(),
                $setSurveyCategoryDeleteResponse->getData(),
                $setSurveyCategoryDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyCategoryDeleteResponse->getMessage(),
                $setSurveyCategoryDeleteResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyOpponentListRequest $request
     */
    public function getSurveyOpponentList(GetSurveyOpponentListRequest $request)
    {
        $getSurveyOpponentListResponse = $this->surveySystemService->GetSurveyOpponentList();
        if ($getSurveyOpponentListResponse->isSuccess()) {
            return $this->success(
                $getSurveyOpponentListResponse->getMessage(),
                $getSurveyOpponentListResponse->getData(),
                $getSurveyOpponentListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyOpponentListResponse->getMessage(),
                $getSurveyOpponentListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyOpponentRequest $request
     */
    public function setSurveyOpponent(SetSurveyOpponentRequest $request)
    {
        $setSurveyOpponentResponse = $this->surveySystemService->SetSurveyOpponent(
            $request->id,
            $request->code,
            $request->name,
            $request->status
        );
        if ($setSurveyOpponentResponse->isSuccess()) {
            return $this->success(
                $setSurveyOpponentResponse->getMessage(),
                $setSurveyOpponentResponse->getData(),
                $setSurveyOpponentResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyOpponentResponse->getMessage(),
                $setSurveyOpponentResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyOpponentEditRequest $request
     */
    public function getSurveyOpponentEdit(GetSurveyOpponentEditRequest $request)
    {
        $getSurveyOpponentEditResponse = $this->surveySystemService->GetSurveyOpponentEdit(
            $request->opponentId
        );
        if ($getSurveyOpponentEditResponse->isSuccess()) {
            return $this->success(
                $getSurveyOpponentEditResponse->getMessage(),
                $getSurveyOpponentEditResponse->getData(),
                $getSurveyOpponentEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyOpponentEditResponse->getMessage(),
                $getSurveyOpponentEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyOpponentDeleteRequest $request
     */
    public function setSurveyOpponentDelete(SetSurveyOpponentDeleteRequest $request)
    {
        $setSurveyOpponentDeleteResponse = $this->surveySystemService->SetSurveyOpponentDelete(
            $request->opponentId
        );
        if ($setSurveyOpponentDeleteResponse->isSuccess()) {
            return $this->success(
                $setSurveyOpponentDeleteResponse->getMessage(),
                $setSurveyOpponentDeleteResponse->getData(),
                $setSurveyOpponentDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyOpponentDeleteResponse->getMessage(),
                $setSurveyOpponentDeleteResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveySoftwareListRequest $request
     */
    public function getSurveySoftwareList(GetSurveySoftwareListRequest $request)
    {
        $getSurveySoftwareListResponse = $this->surveySystemService->GetSurveySoftwareList();
        if ($getSurveySoftwareListResponse->isSuccess()) {
            return $this->success(
                $getSurveySoftwareListResponse->getMessage(),
                $getSurveySoftwareListResponse->getData(),
                $getSurveySoftwareListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveySoftwareListResponse->getMessage(),
                $getSurveySoftwareListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveySoftwareRequest $request
     */
    public function setSurveySoftware(SetSurveySoftwareRequest $request)
    {
        $setSurveySoftwareResponse = $this->surveySystemService->SetSurveySoftware(
            $request->id,
            $request->code,
            $request->name,
            $request->status
        );
        if ($setSurveySoftwareResponse->isSuccess()) {
            return $this->success(
                $setSurveySoftwareResponse->getMessage(),
                $setSurveySoftwareResponse->getData(),
                $setSurveySoftwareResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveySoftwareResponse->getMessage(),
                $setSurveySoftwareResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveySoftwareEditRequest $request
     */
    public function getSurveySoftwareEdit(GetSurveySoftwareEditRequest $request)
    {
        $getSurveySoftwareEditResponse = $this->surveySystemService->GetSurveySoftwareEdit(
            $request->softwareId
        );
        if ($getSurveySoftwareEditResponse->isSuccess()) {
            return $this->success(
                $getSurveySoftwareEditResponse->getMessage(),
                $getSurveySoftwareEditResponse->getData(),
                $getSurveySoftwareEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveySoftwareEditResponse->getMessage(),
                $getSurveySoftwareEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveySoftwareDeleteRequest $request
     */
    public function setSurveySoftwareDelete(SetSurveySoftwareDeleteRequest $request)
    {
        $setSurveySoftwareDeleteResponse = $this->surveySystemService->SetSurveySoftwareDelete(
            $request->softwareId
        );
        if ($setSurveySoftwareDeleteResponse->isSuccess()) {
            return $this->success(
                $setSurveySoftwareDeleteResponse->getMessage(),
                $setSurveySoftwareDeleteResponse->getData(),
                $setSurveySoftwareDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveySoftwareDeleteResponse->getMessage(),
                $setSurveySoftwareDeleteResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyIntegratorListRequest $request
     */
    public function getSurveyIntegratorList(GetSurveyIntegratorListRequest $request)
    {
        $getSurveyIntegratorListResponse = $this->surveySystemService->GetSurveyIntegratorList();
        if ($getSurveyIntegratorListResponse->isSuccess()) {
            return $this->success(
                $getSurveyIntegratorListResponse->getMessage(),
                $getSurveyIntegratorListResponse->getData(),
                $getSurveyIntegratorListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyIntegratorListResponse->getMessage(),
                $getSurveyIntegratorListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyIntegratorRequest $request
     */
    public function setSurveyIntegrator(SetSurveyIntegratorRequest $request)
    {
        $setSurveyIntegratorResponse = $this->surveySystemService->SetSurveyIntegrator(
            $request->id,
            $request->code,
            $request->name,
            $request->status
        );
        if ($setSurveyIntegratorResponse->isSuccess()) {
            return $this->success(
                $setSurveyIntegratorResponse->getMessage(),
                $setSurveyIntegratorResponse->getData(),
                $setSurveyIntegratorResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyIntegratorResponse->getMessage(),
                $setSurveyIntegratorResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSurveyIntegratorEditRequest $request
     */
    public function getSurveyIntegratorEdit(GetSurveyIntegratorEditRequest $request)
    {
        $getSurveyIntegratorEditResponse = $this->surveySystemService->GetSurveyIntegratorEdit(
            $request->integratorId
        );
        if ($getSurveyIntegratorEditResponse->isSuccess()) {
            return $this->success(
                $getSurveyIntegratorEditResponse->getMessage(),
                $getSurveyIntegratorEditResponse->getData(),
                $getSurveyIntegratorEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSurveyIntegratorEditResponse->getMessage(),
                $getSurveyIntegratorEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSurveyIntegratorDeleteRequest $request
     */
    public function setSurveyIntegratorDelete(SetSurveyIntegratorDeleteRequest $request)
    {
        $setSurveyIntegratorDeleteResponse = $this->surveySystemService->SetSurveyIntegratorDelete(
            $request->integratorId
        );
        if ($setSurveyIntegratorDeleteResponse->isSuccess()) {
            return $this->success(
                $setSurveyIntegratorDeleteResponse->getMessage(),
                $setSurveyIntegratorDeleteResponse->getData(),
                $setSurveyIntegratorDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSurveyIntegratorDeleteResponse->getMessage(),
                $setSurveyIntegratorDeleteResponse->getStatusCode()
            );
        }
    }
}
