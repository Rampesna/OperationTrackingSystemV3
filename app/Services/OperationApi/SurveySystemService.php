<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\ISurveySystemService;
use App\Services\ServiceResponse;
use GuzzleHttp\Client;

class SurveySystemService extends OperationApiService implements ISurveySystemService
{
    /**
     * @return ServiceResponse
     */
    public function GetSurveyList(): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get Survey List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function GetSurveyEdit(
        int $id
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyId' => $id
        ];

        return new ServiceResponse(
            true,
            'Get Survey Edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0]
        );
    }

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyQuestionsList(
        int $surveyCode
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyQuestionsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $surveyCode
        ];

        return new ServiceResponse(
            true,
            'Get Survey Questions List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? []
        );
    }

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetSurveyQuestionEdit(
        int $questionId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyQuestionEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyQuestionsId' => $questionId
        ];

        return new ServiceResponse(
            true,
            'Get Survey Question Edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0]
        );
    }

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersList(
        int $questionId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyAnswersList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'QuestionsId' => $questionId
        ];

        return new ServiceResponse(
            true,
            'Get Survey Answers List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? []
        );
    }

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswerEdit(
        int $answerId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyAnswerEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyAnswerId' => $answerId
        ];

        return new ServiceResponse(
            true,
            'Get Survey Answer Edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0]
        );
    }

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyGroupConnectList(
        int $surveyCode
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyGroupConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $surveyCode
        ];

        return new ServiceResponse(
            true,
            'Get Survey Group Connect List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? []
        );
    }

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersConnectList(
        int $answerId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyAnswersConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $answerId
        ];

        return new ServiceResponse(
            true,
            'Get Survey Answers Connect List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? []
        );
    }

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersCategoryConnectList(
        int $answerId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyAnswersCategoryConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $answerId
        ];

        return new ServiceResponse(
            true,
            'Get Survey Answers Category Connect List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? []
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetSurveyProductList(): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyProductList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get Survey Product List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'] ?? []
        );
    }

    /**
     * @return ServiceResponse
     */
    public function GetSurveySellerList(): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveySellerList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get Survey Seller List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response'] ?? []
        );
    }

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function GetSurveyAnswersProductConnectList(
        int $answerId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyAnswersProductConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'AnswersId' => $answerId
        ];

        return new ServiceResponse(
            true,
            'Get Survey Answers Product Connect List',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'] ?? []
        );
    }

    /**
     * @param int $sellerId
     *
     * @return ServiceResponse
     */
    public function GetSurveySellerEdit(
        $sellerId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveySellerEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SellerId' => $sellerId
        ];

        return new ServiceResponse(
            true,
            'Get Survey Seller Edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0]
        );
    }

    /**
     * @param string $sellerCode
     *
     * @return ServiceResponse
     */
    public function GetSurveySellerCodeEdit(
        string $sellerCode
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveySellerCodeEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SellerCode' => $sellerCode
        ];

        return new ServiceResponse(
            true,
            'Get Survey Seller Code Edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0]
        );
    }

    /**
     * @param int $productId
     *
     * @return ServiceResponse
     */
    public function GetSurveyProductEdit(
        int $productId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyProductEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'ProductId' => $productId
        ];

        return new ServiceResponse(
            true,
            'Get Survey Product Edit',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response'][0]
        );
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
     * @param string|null $jobResource
     * @param string|null $listCode
     * @param string|null $status
     * @param int|string $isNewMarketingScreen
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
    ): ServiceResponse
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
            'scriptAnketMi' => $isSurvey,
            'aranmayacakGrupKodu' => $cantCallGroupCode,
            'aciklamaHtml' => $descriptionHtml,
            'aranacakListe' => $callList
        ];

        return new ServiceResponse(
            true,
            'Set Survey',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params)['response']
        );
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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set Survey Questions',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set Survey Answers',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params)['response']
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function SetSurveyDelete(
        int $id
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token
        ];

        $params = [
            'SurveyId' => $id
        ];

        return new ServiceResponse(
            true,
            'Set Survey Delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function SetSurveyQuestionsDelete(
        int $questionId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyQuestionsDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyQuestionsId' => $questionId
        ];

        return new ServiceResponse(
            true,
            'Set Survey Questions Delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }

    /**
     * @param int $answerId
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersDelete(
        int $answerId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyAnswersDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyAnswersId' => $answerId
        ];

        return new ServiceResponse(
            true,
            'Set Survey Answers Delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }

    /**
     * @param int $id
     * @param int $code
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersConnectDelete(
        int $id,
        int $code
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyAnswersConnectDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyAnswersConnectId' => $id,
            'SurveyCode' => $code
        ];

        return new ServiceResponse(
            true,
            'Set Survey Answers Connect Delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }

    /**
     * @param array $categories
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersCategoryConnect(
        array $categories
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyAnswersCategoryConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set Survey Answers Category Connect',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $categories)['response']
        );
    }

    /**
     * @param int $surveyCode
     * @param int $subSurveyCode
     *
     * @return ServiceResponse
     */
    public function SetSurveyGroupConnect(
        int $surveyCode,
        int $subSurveyCode
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyGroupConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'anaAnketGrupKodu' => $surveyCode,
            'ekAnketGrupKodu' => $subSurveyCode
        ];

        return new ServiceResponse(
            true,
            'Set Survey Group Connect',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $params)['response']
        );
    }

    /**
     * @param array $questions
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersConnect(
        array $questions
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyAnswersConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set Survey Answers Connect',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $questions)['response']
        );
    }

    /**
     * @param array $products
     *
     * @return ServiceResponse
     */
    public function SetSurveyAnswersProductConnect(
        array $products
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyAnswersProductConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set Survey Answers Product Connect',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $products)['response']
        );
    }

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
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveySellerConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $list = [];
        foreach ($sellers as $seller) {
            foreach ($surveys as $survey) {
                foreach ($products as $product) {
                    $list[] = [
                        'id' => null,
                        'saticiKodu' => $seller['saticiAdi'],
                        'saticiAdi' => $seller['saticiAdi'],
                        'durum' => 1,
                        'grupKodu' => $survey['kodu'],
                        'urunKodu' => $product['kodu']
                    ];
                }
            }
        }

        return new ServiceResponse(
            true,
            'Set Survey Seller Connect',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @param int $sellerId
     *
     * @return ServiceResponse
     */
    public function SetSurveySellerDelete(
        int $sellerId
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveySellerDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SellerCode' => $sellerId
        ];

        return new ServiceResponse(
            true,
            'Set Survey Seller Delete',
            200,
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($params), 'post', $headers, $params)['response']
        );
    }

    /**
     * @param array $products
     *
     * @return ServiceResponse
     */
    public function SetSurveyProduct(
        array $products
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/SetSurveyProduct";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set Survey Product',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $products)['response']
        );
    }

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
    ): ServiceResponse
    {
        $oldSurvey = $this->GetSurveyEdit($surveyId);
        if ($oldSurvey->isSuccess()) {
            $newSurveyId = $this->SetSurvey(
                null,
                rand(10000, 999999),
                $name,
                $oldSurvey->getData()['aciklama'],
                $oldSurvey->getData()['musteriBilgilendirme'],
                $oldSurvey->getData()['musteriBilgilendirme2'],
                $oldSurvey->getData()['uyumCrmHizmetUrun'],
                $oldSurvey->getData()['uyumCrmCagriNedeni'],
                $oldSurvey->getData()['uyumCrmFirsat'],
                $oldSurvey->getData()['uyumCrmCagri'],
                intval($oldSurvey->getData()['uyumCrmAramaPlani']),
                intval($oldSurvey->getData()['uyumCrmFirsatSaticiyaYonlendir']),
                intval($oldSurvey->getData()['uyumCrmAramaPlaniSaticiyaYonlendir']),
                intval($oldSurvey->getData()['uyumCrmEkUrunFirsat']),
                intval($oldSurvey->getData()['uyumCrmEkUrunAramaPlani']),
                intval($oldSurvey->getData()['uyumCrmSaticiKoduTurKodu']),
                $oldSurvey->getData()['epostaBaslik'] ?? '',
                $oldSurvey->getData()['epostaIcerik'] ?? '',
                $oldSurvey->getData()['uyumCrmIsKaynagi'],
                $oldSurvey->getData()['uyumCrmListeKod'],
                $oldSurvey->getData()['durum'],
                $oldSurvey->getData()['yeniPazarlamaEkraniMi'],
                []
            );

            if ($newSurveyId->isSuccess()) {

            } else {
                return $newSurveyId;
            }
        } else {
            return $oldSurvey;
        }
    }

    /**
     * @param int $surveyCode
     * @param array $guids
     *
     * @return ServiceResponse
     */
    public function SetSurveyPersonConnect(
        int   $surveyCode,
        array $guids
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Set Survey Person Connect',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get Survey Report',
            200,
            json_decode($response->getBody())->response
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get Survey Report Status Details',
            200,
            json_decode($response->getBody())->response
        );
    }

    /**
     * @param int $surveyCode
     *
     * @return ServiceResponse
     */
    public function GetSurveyReportWantedDetails(
        int $surveyCode,
    ): ServiceResponse
    {
        $endpoint = "SurveySystem/GetSurveyReportWantedDetails";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $params = [
            'SurveyCode' => $surveyCode,
        ];

        return new ServiceResponse(
            true,
            'Get Survey Report Wanted Details',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get Survey Report Remaining Details',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $params)['response']
        );
    }

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
    ): ServiceResponse
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

        return new ServiceResponse(
            true,
            'Get Survey Detail Report',
            200,
            json_decode($response->getBody())->response
        );
    }
}
