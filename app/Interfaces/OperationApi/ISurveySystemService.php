<?php


namespace App\Interfaces\OperationApi;

interface ISurveySystemService
{
    public function GetSurveyList();

    public function GetSurveyEdit(
        $id
    );

    public function GetSurveyQuestionsList(
        $surveyCode
    );

    public function GetSurveyQuestionEdit(
        $id
    );

    public function GetSurveyAnswersList(
        $questionId
    );

    public function GetSurveyAnswerEdit(
        $id
    );

    public function GetSurveyGroupConnectList(
        $surveyCode
    );

    public function GetSurveyAnswersConnectList(
        $id
    );

    public function GetSurveyAnswersCategoryConnectList(
        $id
    );

    public function GetSurveyProductList();

    public function GetSurveySellerList();

    public function GetSurveyAnswersProductConnectList(
        $answerId
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

    public function SetSurvey(
        $id,
        $code,
        $name,
        $description,
        $customer_information_1,
        $customer_information_2,
        $service_or_product,
        $call_reason,
        $opportunity,
        $call,
        $dial_plan,
        $opportunity_redirect_to_seller,
        $dial_plan_redirect_to_seller,
        $additional_product_opportunity,
        $additional_product_call_plan,
        $seller_redirection_type,
        $email_title,
        $email_content,
        $job_resource,
        $list_code,
        $status,
        $callList = []
    );

    public function SetSurveyQuestions(
        $id,
        $question,
        $question_type_id,
        $additional_question,
        $order_number,
        $group_code,
        $description,
        $compulsory
    );

    public function SetSurveyAnswers(
        $id,
        $question_id,
        $answer,
        $order_number,
        $columns
    );

    public function SetSurveyDelete(
        $id
    );

    public function SetSurveyQuestionsDelete(
        $id
    );

    public function SetSurveyAnswersDelete(
        $id
    );

    public function SetSurveyAnswersConnectDelete(
        $id,
        $code
    );

    public function SetSurveyAnswersCategoryConnect(
        $list
    );

    public function SetSurveyGroupConnect(
        $mainCode,
        $additionalCode
    );

    public function SetSurveyAnswersConnect(
        $list
    );

    public function SetSurveyAnswersProductConnect(
        $list
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

    public function GetSurveyReport(
        $code,
        $startDate,
        $endDate
    );

    public function GetSurveyReportStatusDetails(
        $code,
        $startDate,
        $endDate,
        $list
    );

    public function GetSurveyReportWantedDetails(
        $code,
        $startDate,
        $endDate
    );

    public function GetSurveyReportRemainingDetails(
        $code,
        $startDate,
        $endDate
    );

    public function GetSurveyDetailReport(
        $code,
        $startDate,
        $endDate
    );
}
