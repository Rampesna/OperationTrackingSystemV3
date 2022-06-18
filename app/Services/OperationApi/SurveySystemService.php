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

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'];
    }

    /**
     * @param int $id
     */
    public function GetSurveyEdit(
        int $id
    )
    {
        $endpoint = "SurveySystem/GetSurveyEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0];
    }

    /**
     * @param int $surveyCode
     */
    public function GetSurveyQuestionsList(
        int $surveyCode
    )
    {
        $endpoint = "SurveySystem/GetSurveyQuestionsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $surveyCode
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? [];
    }

    /**
     * @param int $questionId
     */
    public function GetSurveyQuestionEdit(
        int $questionId
    )
    {
        $endpoint = "SurveySystem/GetSurveyQuestionEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyQuestionsId' => $questionId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0];
    }

    /**
     * @param int $questionId
     */
    public function GetSurveyAnswersList(
        int $questionId
    )
    {
        $endpoint = "SurveySystem/GetSurveyAnswersList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'QuestionsId' => $questionId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? [];
    }

    /**
     * @param int $answerId
     */
    public function GetSurveyAnswerEdit(
        int $answerId
    )
    {
        $endpoint = "SurveySystem/GetSurveyAnswerEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyAnswerId' => $answerId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0];
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

    /**
     * @param int $answerId
     */
    public function GetSurveyAnswersConnectList(
        int $answerId
    )
    {
        $endpoint = "SurveySystem/GetSurveyAnswersConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $answerId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? [];
    }

    /**
     * @param int $answerId
     */
    public function GetSurveyAnswersCategoryConnectList(
        int $answerId
    )
    {
        $endpoint = "SurveySystem/GetSurveyAnswersCategoryConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $answerId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? [];
    }

    public function GetSurveyProductList()
    {
        $endpoint = "SurveySystem/GetSurveyProductList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'] ?? [];
    }

    public function GetSurveySellerList()
    {
        $endpoint = "SurveySystem/GetSurveySellerList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetSurveyAnswersProductConnectList(
        int $answerId
    )
    {
        $endpoint = "SurveySystem/GetSurveyAnswersProductConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $answerId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? [];
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
            'musteriBilgilendirme' => $customerInformation1,
            'musteriBilgilendirme2' => $customerInformation2,
            'uyumCrmHizmetUrun' => $serviceProduct,
            'uyumCrmCagriNedeni' => $callReason,
            'uyumCrmFirsat' => $opportunity,
            'uyumCrmCagri' => $call,
            'uyumCrmAramaPlani' => $dialPlan,
            'uyumCrmFirsatSaticiyaYonlendir' => $opportunityRedirectToSeller,
            'uyumCrmAramaPlaniSaticiyaYonlendir' => $dialPlanRedirectToSeller,
            'uyumCrmEkUrunFirsat' => $additionalProductOpportunity,
            'uyumCrmEkUrunAramaPlani' => $additionalProductCallPlan,
            'uyumCrmSaticiKoduTurKodu' => $sellerRedirectionType,
            'epostaBaslik' => $emailTitle,
            'epostaIcerik' => $emailContent,
            'uyumCrmIsKaynagi' => $jobResource,
            'uyumCrmListeKod' => $listCode,
            'durum' => $status,
            'aranacakListe' => $callList
        ];

//        return $params;

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

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
    )
    {
        $endpoint = "SurveySystem/SetSurveyQuestions";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'id' => $id,
            'soru' => $question,
            'soruTurKodu' => $typeId,
            'ekCevapString' => $additionalQuestion,
            'siraNo' => $order,
            'grupKodu' => $surveyCode,
            'soruAciklama' => $description,
            'zorunlumu' => $required
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

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
    )
    {
        $endpoint = "SurveySystem/SetSurveyAnswers";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'id' => $id,
            'anketSorularId' => $questionId,
            'cevap' => $answer,
            'siraNo' => $order,
            'zorunluKolonAdlari' => $columns
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params)['response'];
    }

    /**
     * @param int $id
     */
    public function SetSurveyDelete(
        int $id
    )
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

    /**
     * @param int $questionId
     */
    public function SetSurveyQuestionsDelete(
        int $questionId
    )
    {
        $endpoint = "SurveySystem/SetSurveyQuestionsDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyQuestionsId' => $questionId
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params);
    }

    /**
     * @param int $answerId
     */
    public function SetSurveyAnswersDelete(
        int $answerId
    )
    {
        $endpoint = "SurveySystem/SetSurveyAnswersDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyAnswersId' => $answerId
        ];

        return $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response'];
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

    /**
     * @param array $categories
     */
    public function SetSurveyAnswersCategoryConnect(
        array $categories
    )
    {
        $endpoint = "SurveySystem/SetSurveyAnswersCategoryConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $categories);
    }

    /**
     * @param int $surveyCode
     * @param int $subSurveyCode
     */
    public function SetSurveyGroupConnect(
        $surveyCode,
        $subSurveyCode
    )
    {
        $endpoint = "SurveySystem/SetSurveyGroupConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'anaAnketGrupKodu' => $surveyCode,
            'ekAnketGrupKodu' => $subSurveyCode
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params);
    }

    /**
     * @param array $questions
     */
    public function SetSurveyAnswersConnect(
        array $questions
    )
    {
        $endpoint = "SurveySystem/SetSurveyAnswersConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $questions);
    }

    /**
     * @param array $products
     */
    public function SetSurveyAnswersProductConnect(
        array $products
    )
    {
        $endpoint = "SurveySystem/SetSurveyAnswersProductConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $products);
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

    /**
     * @param int $surveyCode
     * @param array $guids
     */
    public function SetSurveyPersonConnect(
        int   $surveyCode,
        array $guids
    )
    {
        $endpoint = "SurveySystem/SetSurveyPersonConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $list = [];
        foreach ($guids as $guid) {
            $list[] = [
                'grupKodu' => $surveyCode,
                'personId' => $guid
            ];
        }

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }

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
    )
    {
        $endpoint = "SurveySystem/GetSurveyReport";

        $parameters = [
            'SurveyCode' => $surveyCode,
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $client = new Client;
        $response = $client->request('post', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($companyIds),
            'query' => $parameters
        ]);

        return json_decode($response->getBody())->response;
    }

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
    )
    {
        $endpoint = "SurveySystem/GetSurveyReportStatusDetails";

        $parameters = [
            'SurveyCode' => $surveyCode,
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $client = new Client;
        $response = $client->request('post', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($statusCodes),
            'query' => $parameters
        ]);

        return json_decode($response->getBody())->response;
    }

    /**
     * @param int $surveyCode
     */
    public function GetSurveyReportWantedDetails(
        int $surveyCode,
    )
    {
        $endpoint = "SurveySystem/GetSurveyReportWantedDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $surveyCode,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'];
    }

    /**
     * @param int $surveyCode
     * @param string $startDate
     * @param string $endDate
     */
    public function GetSurveyReportRemainingDetails(
        int    $surveyCode,
        string $startDate,
        string $endDate
    )
    {
        $endpoint = "SurveySystem/GetSurveyReportRemainingDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $surveyCode,
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'];
    }

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
    )
    {
        $endpoint = "SurveySystem/GetSurveyDetailReport";

        $parameters = [
            'SurveyCode' => $surveyCode,
            'BaslangicTarihi' => $startDate,
            'BitisTarihi' => $endDate
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $client = new Client;
        $response = $client->request('post', $this->baseUrl . $endpoint, [
            'headers' => $headers,
            'body' => json_encode($companyIds),
            'query' => $parameters
        ]);

        return json_decode($response->getBody())->response;
    }
}
