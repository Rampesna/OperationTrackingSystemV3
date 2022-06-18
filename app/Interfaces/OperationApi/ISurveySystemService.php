<?php


namespace App\Interfaces\OperationApi;

interface ISurveySystemService
{
    public function GetSurveyList();

    /**
     * @param int $id
     */
    public function GetSurveyEdit(
        int $id
    );

    /**
     * @param int $surveyCode
     */
    public function GetSurveyQuestionsList(
        int $surveyCode
    );

    /**
     * @param int $questionId
     */
    public function GetSurveyQuestionEdit(
        int $questionId
    );

    /**
     * @param int $questionId
     */
    public function GetSurveyAnswersList(
        int $questionId
    );

    /**
     * @param int $answerId
     */
    public function GetSurveyAnswerEdit(
        int $answerId
    );

    public function GetSurveyGroupConnectList(
        $surveyCode
    );

    /**
     * @param int $answerId
     */
    public function GetSurveyAnswersConnectList(
        int $answerId
    );

    /**
     * @param int $answerId
     */
    public function GetSurveyAnswersCategoryConnectList(
        int $answerId
    );

    public function GetSurveyProductList();

    public function GetSurveySellerList();

    /**
     * @param int $answerId
     */
    public function GetSurveyAnswersProductConnectList(
        int $answerId
    );

    public function GetSurveySellerEdit(
        $sellerId
    );

    public function GetSurveySellerCodeEdit(
        $sellerCode
    );

    public function GetSurveyProductEdit(
        $productId
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
     */
    public function SetSurveyDelete(
        int $id
    );

    /**
     * @param int $questionId
     */
    public function SetSurveyQuestionsDelete(
        int $questionId
    );

    /**
     * @param int $answerId
     */
    public function SetSurveyAnswersDelete(
        int $answerId
    );

    public function SetSurveyAnswersConnectDelete(
        $id,
        $code
    );

    /**
     * @param array $categories
     */
    public function SetSurveyAnswersCategoryConnect(
        array $categories
    );

    /**
     * @param int $surveyCode
     * @param int $subSurveyCode
     */
    public function SetSurveyGroupConnect(
        $surveyCode,
        $subSurveyCode
    );

    /**
     * @param array $questions
     */
    public function SetSurveyAnswersConnect(
        array $questions
    );

    /**
     * @param array $products
     */
    public function SetSurveyAnswersProductConnect(
        array $products
    );

    public function SetSurveySellerConnect(
        $list
    );

    public function SetSurveySellerDelete(
        $sellerId
    );

    public function SetSurveyProduct(
        $list
    );

    /**
     * @param int $surveyCode
     * @param array $guids
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
     */
    public function GetSurveyReportStatusDetails(
        int    $surveyCode,
        string $startDate,
        string $endDate,
        array  $statusCodes
    );

    /**
     * @param int $surveyCode
     */
    public function GetSurveyReportWantedDetails(
        int $surveyCode,
    );

    /**
     * @param int $surveyCode
     * @param string $startDate
     * @param string $endDate
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
     */
    public function GetSurveyDetailReport(
        int    $surveyCode,
        string $startDate,
        string $endDate,
        array  $companyIds
    );
}
