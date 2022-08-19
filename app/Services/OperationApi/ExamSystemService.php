<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IExamSystemService;
use App\Services\ServiceResponse;

class ExamSystemService extends OperationApiService implements IExamSystemService
{
    /**
     * @return ServiceResponse
     */
    public function GetExamList(): ServiceResponse
    {
        $endpoint = "ExamSystem/GetExamList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Get exam list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers)['response']
        );
    }

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamPersonConnectList(
        int $examId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetExamPersonConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId
        ];

        return new ServiceResponse(
            true,
            'Get exam person connect list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetQuestionsList(
        int $examId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetQuestionsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId
        ];

        return new ServiceResponse(
            true,
            'Get questions list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetQuestionOptionsList(
        int $questionId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetQuestionOptionsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'QuestionId' => $questionId
        ];

        return new ServiceResponse(
            true,
            'Get question options list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultReadingList(
        int $examId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetExamResultReadingList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId
        ];

        return new ServiceResponse(
            true,
            'Get exam result reading list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $employeeGuid
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultReadingReplyList(
        int $employeeGuid,
        int $examId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetExamResultReadingReplyList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId,
            'PersonId' => $employeeGuid
        ];

        return new ServiceResponse(
            true,
            'Get exam result reading reply list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultList(
        int $examId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetExamResultList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId
        ];

        return new ServiceResponse(
            true,
            'Get exam result list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $time
     * @param string $date
     *
     * @return ServiceResponse
     */
    public function SetExams(
        string $name,
        string $description,
        string $time,
        string $date
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetExams";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'sinavAdi' => $name,
                'sinavAciklamasi' => $description,
                'sinavSuresi' => $time,
                'sinavTarihi' => $date
            ]
        ];

        return new ServiceResponse(
            true,
            'Set exams',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $userId
     * @param int $examId
     * @param int $remainingTime
     * @param int $status
     *
     * @return ServiceResponse
     */
    public function SetExamPersonConnect(
        int $userId,
        int $examId,
        int $remainingTime,
        int $status
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetExamPersonConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'kullaniciId' => $userId,
                'sinavId' => $examId,
                'kalanSure' => $remainingTime,
                'durum' => $status
            ]
        ];

        return new ServiceResponse(
            true,
            'Set exam person connect',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $examId
     * @param string $question
     * @param int $questionType
     * @param int $order
     * @param string $image
     *
     * @return ServiceResponse
     */
    public function SetQuestions(
        int    $examId,
        string $question,
        int    $questionType,
        int    $order,
        string $image
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetQuestions";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'sinavId' => $examId,
                'soru' => $question,
                'soruTuru' => $questionType,
                'siraNo' => $order,
                'resim' => $image
            ]
        ];

        return new ServiceResponse(
            true,
            'Set questions',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $questionId
     * @param string $answer
     * @param int $orderNumber
     *
     * @return ServiceResponse
     */
    public function SetQuestionOptions(
        int    $questionId,
        string $answer,
        int    $orderNumber
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetQuestions";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'body' => [
                'soruId' => $questionId,
                'cevap' => $answer,
                'siraNo' => $orderNumber
            ]
        ];

        return new ServiceResponse(
            true,
            'Set question options',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function SetExamResultReadingReply(
        array $list
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetExamResultReadingReply";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set exam result reading reply',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }
}
