<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface ISurveySystemService
{
    /**
     * @return ServiceResponse
     */
    public function GetSurveyList(): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetSurveyEdit(
        int $id
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyQuestionsList(
        int $surveyCode
    ): ServiceResponse;

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetSurveyQuestionEdit(
        int $questionId
    ): ServiceResponse;

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersList(
        int $questionId
    ): ServiceResponse;

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswerEdit(
        int $answerId
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyGroupConnectList(
        int $surveyCode
    ): ServiceResponse;

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersConnectList(
        int $answerId
    ): ServiceResponse;

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersCategoryConnectList(
        int $answerId
    ): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetSurveyProductList(): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetSurveySellerList(): ServiceResponse;

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersProductConnectList(
        int $answerId
    ): ServiceResponse;

    /**
     * @param int $sellerId
     *
     * @return ServiceResponse
     */
    public function GetSurveySellerEdit(
        $sellerId
    ): ServiceResponse;

    /**
     * @param string $sellerCode
     *
     * @return ServiceResponse
     */
    public function GetSurveySellerCodeEdit(
        string $sellerCode
    ): ServiceResponse;

    /**
     * @param int $productId
     *
     * @return ServiceResponse
     */
    public function GetSurveyProductEdit(
        int $productId
    ): ServiceResponse;

    /**
     * @param int|null $id
     * @param int $code
     * @param string $name
     * @param string $description
     * @param string $customerInformation1
     * @param string $customerInformation2
     * @param string|null $serviceProduct
     * @param string $callReason
     * @param int $opportunity
     * @param int $call
     * @param int $dialPlan
     * @param int $opportunityRedirectToSeller
     * @param int $dialPlanRedirectToSeller
     * @param int $additionalProductOpportunity
     * @param int $additionalProductCallPlan
     * @param int $sellerRedirectionType
     * @param string|null $emailTitle
     * @param string|null $emailContent
     * @param string|null $jobResource
     * @param string|null $listCode
     * @param string|null $status
     * @param int|string $isNewMarketingScreen
     * @param int $isSurvey
     * @param string|null $cantCallGroupCode
     * @param string|null $descriptionHtml
     * @param array|null $callList
     *
     * @return ServiceResponse
     */
    public function SetSurvey(
        int|null    $id,
        int         $code,
        string      $name,
        string      $description,
        string      $customerInformation1,
        string      $customerInformation2,
        string|null $serviceProduct,
        string      $callReason,
        int         $opportunity,
        int         $call,
        int         $dialPlan,
        int         $opportunityRedirectToSeller,
        int         $dialPlanRedirectToSeller,
        int         $additionalProductOpportunity,
        int         $additionalProductCallPlan,
        int         $sellerRedirectionType,
        string|null $emailTitle,
        string|null $emailContent,
        ?string     $jobResource,
        string|null $listCode,
        string|null $status,
        int|string  $isNewMarketingScreen,
        int         $isSurvey,
        string|null $cantCallGroupCode,
        string|null $descriptionHtml,
        array|null  $callList = []
    ): ServiceResponse;

    /**
     * @param int|null $id
     * @param string $question
     * @param int $typeId
     * @param int $additionalQuestion
     * @param int $order
     * @param int $surveyCode
     * @param string|null $description
     * @param int $required
     *
     * @return ServiceResponse
     */
    public function SetSurveyQuestions(
        int|null    $id,
        string      $question,
        int         $typeId,
        int         $additionalQuestion,
        int         $order,
        int         $surveyCode,
        string|null $description,
        int         $required
    ): ServiceResponse;

    /**
     * @param int|null $id
     * @param int $questionId
     * @param string $answer
     * @param int $order
     * @param string $columns
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswers(
        int|null $id,
        int      $questionId,
        string   $answer,
        int      $order,
        string   $columns
    ): ServiceResponse;

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetSurveyDelete(
        int $id
    ): ServiceResponse;

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function SetSurveyQuestionsDelete(
        int $questionId
    ): ServiceResponse;

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersDelete(
        int $answerId
    ): ServiceResponse;

    /**
     * @param int $id
     * @param int $code
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersConnectDelete(
        int $id,
        int $code
    ): ServiceResponse;

    /**
     * @param array $categories
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersCategoryConnect(
        array $categories
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     * @param int $subSurveyCode
     *
     * @return ServiceResponse
     */
    public function SetSurveyGroupConnect(
        int $surveyCode,
        int $subSurveyCode
    ): ServiceResponse;

    /**
     * @param array $questions
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersConnect(
        array $questions
    ): ServiceResponse;

    /**
     * @param array $products
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersProductConnect(
        array $products
    ): ServiceResponse;

    /**
     * @param array $sellers
     * @param array $surveys
     * @param array $products
     *
     * @return ServiceResponse
     */
    public function SetSurveySellerConnect(
        array $sellers,
        array $surveys,
        array $products
    ): ServiceResponse;

    /**
     * @param int $sellerId
     *
     * @return ServiceResponse
     */
    public function SetSurveySellerDelete(
        int $sellerId
    ): ServiceResponse;

    /**
     * @param array $products
     *
     * @return ServiceResponse
     */
    public function SetSurveyProduct(
        array $products
    ): ServiceResponse;

    /**
     * @param int $surveyId
     * @param string $surveyCode
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function CopySurvey(
        int    $surveyId,
        string $surveyCode,
        string $name
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     * @param array $guids
     *
     * @return ServiceResponse
     */
    public function SetSurveyPersonConnect(
        int   $surveyCode,
        array $guids
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     * @param string $startDate
     * @param string $endDate
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function GetSurveyReport(
        int    $surveyCode,
        string $startDate,
        string $endDate,
        array  $companyIds
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     * @param string $startDate
     * @param string $endDate
     * @param array $statusCodes
     *
     * @return ServiceResponse
     */
    public function GetSurveyReportStatusDetails(
        int    $surveyCode,
        string $startDate,
        string $endDate,
        array  $statusCodes
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyReportWantedDetails(
        int $surveyCode,
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function GetSurveyReportRemainingDetails(
        int    $surveyCode,
        string $startDate,
        string $endDate
    ): ServiceResponse;

    /**
     * @param int $surveyCode
     * @param string $startDate
     * @param string $endDate
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function GetSurveyDetailReport(
        int    $surveyCode,
        string $startDate,
        string $endDate,
        array  $companyIds
    ): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetSurveyCategoryList(): ServiceResponse;

    /**
     * @param int|null $id
     * @param string $code
     * @param string $name
     * @param string $typeCode
     * @param int $status
     *
     * @return ServiceResponse
     */
    public function SetSurveyCategory(
        int|null $id,
        string   $code,
        string   $name,
        string   $typeCode,
        int      $status
    ): ServiceResponse;

    /**
     * @param int $categoryId
     *
     * @return ServiceResponse
     */
    public function GetSurveyCategoryEdit(
        int $categoryId
    ): ServiceResponse;

    /**
     * @param int $categoryId
     *
     * @return ServiceResponse
     */
    public function SetSurveyCategoryDelete(
        int $categoryId
    ): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetSurveyOpponentList(): ServiceResponse;

    /**
     * @param int|null $id
     * @param string $code
     * @param string $name
     * @param int $status
     *
     * @return ServiceResponse
     */
    public function SetSurveyOpponent(
        int|null $id,
        string   $code,
        string   $name,
        int      $status
    ): ServiceResponse;

    /**
     * @param int $opponentId
     *
     * @return ServiceResponse
     */
    public function GetSurveyOpponentEdit(
        int $opponentId
    ): ServiceResponse;

    /**
     * @param int $opponentId
     *
     * @return ServiceResponse
     */
    public function SetSurveyOpponentDelete(
        int $opponentId
    ): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetSurveySoftwareList(): ServiceResponse;

    /**
     * @param int|null $id
     * @param string $code
     * @param string $name
     * @param int $status
     *
     * @return ServiceResponse
     */
    public function SetSurveySoftware(
        int|null $id,
        string   $code,
        string   $name,
        int      $status
    ): ServiceResponse;

    /**
     * @param int $softwareId
     *
     * @return ServiceResponse
     */
    public function GetSurveySoftwareEdit(
        int $softwareId
    ): ServiceResponse;

    /**
     * @param int $softwareId
     *
     * @return ServiceResponse
     */
    public function SetSurveySoftwareDelete(
        int $softwareId
    ): ServiceResponse;

    /**
     * @return ServiceResponse
     */
    public function GetSurveyIntegratorList(): ServiceResponse;

    /**
     * @param int|null $id
     * @param string $code
     * @param string $name
     * @param int $status
     *
     * @return ServiceResponse
     */
    public function SetSurveyIntegrator(
        int|null $id,
        string   $code,
        string   $name,
        int      $status
    ): ServiceResponse;

    /**
     * @param int $integratorId
     *
     * @return ServiceResponse
     */
    public function GetSurveyIntegratorEdit(
        int $integratorId
    ): ServiceResponse;

    /**
     * @param int $integratorId
     *
     * @return ServiceResponse
     */
    public function SetSurveyIntegratorDelete(
        int $integratorId
    ): ServiceResponse;
}
