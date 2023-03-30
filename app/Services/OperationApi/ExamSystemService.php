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
            'examId' => $examId
        ];

        return new ServiceResponse(
            true,
            'Get exam person connect list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response'] ?? []
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
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'get', $headers, $parameters)['response']
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
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamEdit(
        int $examId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetExamEdit";
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
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetQuestionsEdit(
        int $questionId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetQuestionsEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'QuestionId' => $questionId
        ];

        return new ServiceResponse(
            true,
            'Get exam result list',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $questionOptionId
     *
     * @return ServiceResponse
     */
    public function GetQuestionOptionsEdit(
        int $questionOptionId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/GetQuestionOptionsEdit";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'QuestionOptionsId' => $questionOptionId
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
     * @param string $duration
     * @param string $date
     * @param mixed|null $id
     *
     * @return ServiceResponse
     */
    public function SetExams(
        string $name,
        string $description,
        string $duration,
        string $date,
        mixed  $id = null
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetExams";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'id' => $id,
            'sinavAdi' => $name,
            'sinavAciklamasi' => $description,
            'sinavSuresi' => $duration,
            'sinavTarihi' => $date
        ];

        return new ServiceResponse(
            true,
            'Set exams',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function SetExamDelete(
        int $examId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetExamDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'examId' => $examId,
        ];

        return new ServiceResponse(
            true,
            'Set exams delete',
            200,
//            $parameters
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function SetQuestionsDelete(
        int $questionId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetQuestionsDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'questionsId' => $questionId,
        ];

        return new ServiceResponse(
            true,
            'SetQuestionsDelete',
            200,
//            $parameters
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param int $questionOptionId
     *
     * @return ServiceResponse
     */
    public function SetQuestionOptionsDelete(
        int $questionOptionId
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetQuestionOptionsDelete";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'questionOptionsId' => $questionOptionId,
        ];

        return new ServiceResponse(
            true,
            'SetQuestionsDelete',
            200,
//            $parameters
            $this->callApi($this->baseUrl . $endpoint . '?' . http_build_query($parameters), 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param array $list {
     * @type string $kullaniciId
     * @type string $sinavId
     * @type string $kalanSure
     * @type string $durum
     * }
     *
     * @return ServiceResponse
     */
    public function SetExamPersonConnect(
        array $list
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetExamPersonConnect";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return new ServiceResponse(
            true,
            'Set exam person connect',
            200,
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list)['response']
        );
    }

    /**
     * @param mixed $id
     * @param int $examId
     * @param string $question
     * @param int $questionType
     * @param int $order
     * @param string|null $image
     *
     * @return ServiceResponse
     */
    public function SetQuestions(
        mixed       $id,
        int         $examId,
        string      $question,
        int         $questionType,
        int         $order,
        string|null $image = null
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetQuestions";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'id' => $id,
            'sinavId' => $examId,
            'soru' => $question,
            'soruTuru' => $questionType,
            'siraNo' => $order,
            'resim' => $image
        ];

        return new ServiceResponse(
            true,
            'Set questions',
            200,
//            $parameters
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)['response']
        );
    }

    /**
     * @param mixed $id
     * @param int $questionId
     * @param string $answer
     * @param int $orderNumber
     *
     * @return ServiceResponse
     */
    public function SetQuestionOptions(
        mixed  $id,
        int    $questionId,
        string $answer,
        int    $order
    ): ServiceResponse
    {
        $endpoint = "ExamSystem/SetQuestionOptions";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'id' => $id,
            'soruId' => $questionId,
            'cevap' => $answer,
            'siraNo' => $order
        ];

        return new ServiceResponse(
            true,
            'Set question options',
            200,
//            $parameters
            $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters)->body()
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
