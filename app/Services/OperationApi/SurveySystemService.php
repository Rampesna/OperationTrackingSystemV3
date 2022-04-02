<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\ISurveySystemService;
use GuzzleHttp\Client;

class SurveySystemService extends OperationApiService implements ISurveySystemService
{
    public function GetSurveyList()
    {
        $endpoint = "SurveySystem/GetSurveyList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetSurveyEdit($id)
    {
        $endpoint = "SurveySystem/GetSurveyEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyQuestionsList($surveyCode)
    {
        $endpoint = "SurveySystem/GetSurveyQuestionsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $surveyCode
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyQuestionEdit($id)
    {
        $endpoint = "SurveySystem/GetSurveyQuestionEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyQuestionsId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyAnswersList($questionId)
    {
        $endpoint = "SurveySystem/GetSurveyAnswersList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'QuestionsId' => $questionId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyAnswerEdit($id)
    {
        $endpoint = "SurveySystem/GetSurveyAnswerEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyAnswerId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyGroupConnectList($surveyCode)
    {
        $endpoint = "SurveySystem/GetSurveyGroupConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $surveyCode
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyAnswersConnectList($id)
    {
        $endpoint = "SurveySystem/GetSurveyAnswersConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyAnswersCategoryConnectList($id)
    {
        $endpoint = "SurveySystem/GetSurveyAnswersCategoryConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyProductList()
    {
        $endpoint = "SurveySystem/GetSurveyProductList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetSurveySellerList()
    {
        $endpoint = "SurveySystem/GetSurveySellerList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetSurveyAnswersProductConnectList($answerId)
    {
        $endpoint = "SurveySystem/GetSurveyAnswersProductConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $answerId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveySellerEdit($sellerId)
    {
        $endpoint = "SurveySystem/GetSurveySellerEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SellerId' => $sellerId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveySellerCodeEdit($sellerCode)
    {
        $endpoint = "SurveySystem/GetSurveySellerCodeEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SellerCode' => $sellerCode
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyProductEdit($productId)
    {
        $endpoint = "SurveySystem/GetSurveyProductEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'ProductId' => $productId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

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
    )
    {
        $endpoint = "SurveySystem/SetSurvey";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'id' => $id,
            'kodu' => $code,
            'adi' => $name,
            'aciklama' => $description,
            'musteriBilgilendirme' => $customer_information_1,
            'musteriBilgilendirme2' => $customer_information_2,
            'uyumCrmHizmetUrun' => $service_or_product,
            'uyumCrmCagriNedeni' => $call_reason,
            'uyumCrmFirsat' => $opportunity,
            'uyumCrmCagri' => $call,
            'uyumCrmAramaPlani' => intval($dial_plan),
            'uyumCrmFirsatSaticiyaYonlendir' => intval($opportunity_redirect_to_seller),
            'uyumCrmAramaPlaniSaticiyaYonlendir' => intval($dial_plan_redirect_to_seller),
            'uyumCrmEkUrunFirsat' => intval($additional_product_opportunity),
            'uyumCrmEkUrunAramaPlani' => intval($additional_product_call_plan),
            'uyumCrmSaticiKoduTurKodu' => intval($seller_redirection_type),
            'epostaBaslik' => $email_title,
            'epostaIcerik' => $email_content,
            'uyumCrmIsKaynagi' => $job_resource,
            'uyumCrmListeKod' => $list_code,
            'durum' => $status,
            'aranacakListe' => $callList
        ];

//        return $params;

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

    public function SetSurveyQuestions(
        $id,
        $question,
        $question_type_id,
        $additional_question,
        $order_number,
        $group_code,
        $description,
        $compulsory
    )
    {
        $endpoint = "SurveySystem/SetSurveyQuestions";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'id' => $id,
            'soru' => $question,
            'soruTurKodu' => $question_type_id,
            'ekCevapString' => $additional_question,
            'siraNo' => $order_number,
            'grupKodu' => $group_code,
            'soruAciklama' => $description,
            'zorunlumu' => $compulsory
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

    public function SetSurveyAnswers(
        $id,
        $question_id,
        $answer,
        $order_number,
        $columns
    )
    {
        $endpoint = "SurveySystem/SetSurveyAnswers";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'id' => $id,
            'anketSorularId' => $question_id,
            'cevap' => $answer,
            'siraNo' => $order_number,
            'zorunluKolonAdlari' => $columns
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

    public function SetSurveyDelete($id)
    {
        $endpoint = "SurveySystem/SetSurveyDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token
        ];

        $params = [
            'SurveyId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    public function SetSurveyQuestionsDelete($id)
    {
        $endpoint = "SurveySystem/SetSurveyQuestionsDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyQuestionsId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    public function SetSurveyAnswersDelete($id)
    {
        $endpoint = "SurveySystem/SetSurveyAnswersDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyAnswersId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    public function SetSurveyAnswersConnectDelete($id, $code)
    {
        $endpoint = "SurveySystem/SetSurveyAnswersConnectDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyAnswersConnectId' => $id,
            'SurveyCode' => $code
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    public function SetSurveyAnswersCategoryConnect($list)
    {
        $endpoint = "SurveySystem/SetSurveyAnswersCategoryConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetSurveyGroupConnect($mainCode, $additionalCode)
    {
        $endpoint = "SurveySystem/SetSurveyGroupConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'anaAnketGrupKodu' => $mainCode,
            'ekAnketGrupKodu' => $additionalCode
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

    public function SetSurveyAnswersConnect($list)
    {
        $endpoint = "SurveySystem/SetSurveyAnswersConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetSurveyAnswersProductConnect($list)
    {
        $endpoint = "SurveySystem/SetSurveyAnswersProductConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetSurveySellerConnect($list)
    {
        $endpoint = "SurveySystem/SetSurveySellerConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetSurveySellerDelete($sellerId)
    {
        $endpoint = "SurveySystem/SetSurveySellerDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SellerCode' => $sellerId
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    public function SetSurveyProduct($list)
    {
        $endpoint = "SurveySystem/SetSurveyProduct";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function SetSurveyPersonConnect($list)
    {
        $endpoint = "SurveySystem/SetSurveyPersonConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

    public function GetSurveyReport($code, $startDate, $endDate)
    {
        $endpoint = "SurveySystem/GetSurveyReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $code,
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyReportStatusDetails($code, $startDate, $endDate, $list)
    {
        $endpoint = "SurveySystem/GetSurveyReportStatusDetails";

        $parameters = [
            'SurveyCode' => $code,
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $client = new Client;
        $response = $client->request('get', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($list),
            'query' => $parameters
        ]);

        return $response;
    }

    public function GetSurveyReportWantedDetails($code, $startDate, $endDate)
    {
        $endpoint = "SurveySystem/GetSurveyReportWantedDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $code,
            'BaslangicTarihi' => null,
            'BitisTarihi' => null
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyReportRemainingDetails($code, $startDate, $endDate)
    {
        $endpoint = "SurveySystem/GetSurveyReportRemainingDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $code,
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }

    public function GetSurveyDetailReport($code, $startDate, $endDate)
    {
        $endpoint = "SurveySystem/GetSurveyDetailReport";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $code,
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params);
    }
}
