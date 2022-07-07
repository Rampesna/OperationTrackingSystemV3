<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface ISurveySystemService
{
    /**
     * @return ServiceResponse
     */
    public function GetSurveyList();

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetSurveyEdit(
        int $id
    );

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyQuestionsList(
        int $surveyCode
    );

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetSurveyQuestionEdit(
        int $questionId
    );

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersList(
        int $questionId
    );

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswerEdit(
        int $answerId
    );

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyGroupConnectList(
        int $surveyCode
    );

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersConnectList(
        int $answerId
    );

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersCategoryConnectList(
        int $answerId
    );

    /**
     * @return ServiceResponse
     */
    public function GetSurveyProductList();

    /**
     * @return ServiceResponse
     */
    public function GetSurveySellerList();

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersProductConnectList(
        int $answerId
    );

    /**
     * @param int $sellerId
     *
     * @return ServiceResponse
     */
    public function GetSurveySellerEdit(
        $sellerId
    );

    /**
     * @param string $sellerCode
     *
     * @return ServiceResponse
     */
    public function GetSurveySellerCodeEdit(
        string $sellerCode
    );

    /**
     * @param int $productId
     *
     * @return ServiceResponse
     */
    public function GetSurveyProductEdit(
        int $productId
    );

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
     * @param string $jobResource
     * @param string|null $listCode
     * @param string|null $status
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
        string      $jobResource,
        string|null $listCode,
        string|null $status,
        array|null  $callList = []
    );

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
    );

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
    );

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetSurveyDelete(
        int $id
    );

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function SetSurveyQuestionsDelete(
        int $questionId
    );

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersDelete(
        int $answerId
    );

    /**
     * @param int $id
     * @param int $code
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersConnectDelete(
        int $id,
        int $code
    );

    /**
     * @param array $categories
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersCategoryConnect(
        array $categories
    );

    /**
     * @param int $surveyCode
     * @param int $subSurveyCode
     *
     * @return ServiceResponse
     */
    public function SetSurveyGroupConnect(
        int $surveyCode,
        int $subSurveyCode
    );

    /**
     * @param array $questions
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersConnect(
        array $questions
    );

    /**
     * @param array $products
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersProductConnect(
        array $products
    );

    /**
     * @param array $sellers
     *
     * @return ServiceResponse
     */
    public function SetSurveySellerConnect(
        array $sellers
    );

    /**
     * @param int $sellerId
     *
     * @return ServiceResponse
     */
    public function SetSurveySellerDelete(
        int $sellerId
    );

    /**
     * @param array $products
     *
     * @return ServiceResponse
     */
    public function SetSurveyProduct(
        array $products
    );

    /**
     * @param int $surveyCode
     * @param array $guids
     *
     * @return ServiceResponse
     */
    public function SetSurveyPersonConnect(
        int   $surveyCode,
        array $guids
    );

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
    );

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
    );

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyReportWantedDetails(
        int $surveyCode,
    );

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
    );

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
    );
}
