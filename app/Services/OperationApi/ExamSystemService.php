<?php


namespace App\Services\OperationApi;

use App\Interfaces\OperationApi\IExamSystemService;

class ExamSystemService extends OperationApiService implements IExamSystemService
{
    public function GetExamList()
    {
        $endpoint = "ExamSystem/GetExamList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers);
    }

    public function GetExamPersonConnectList($examId)
    {
        $endpoint = "ExamSystem/GetExamPersonConnectList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetQuestionsList($examId)
    {
        $endpoint = "ExamSystem/GetQuestionsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetQuestionOptionsList($questionId)
    {
        $endpoint = "ExamSystem/GetQuestionOptionsList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'QuestionId' => $questionId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetExamResultReadingList($examId)
    {
        $endpoint = "ExamSystem/GetExamResultReadingList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetExamResultReadingReplyList($id, $examId)
    {
        $endpoint = "ExamSystem/GetExamResultReadingReplyList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId,
            'PersonId' => $id
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function GetExamResultList($examId)
    {
        $endpoint = "ExamSystem/GetExamResultList";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        $parameters = [
            'ExamId' => $examId
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'get', $headers, $parameters);
    }

    public function SetExams($name, $description, $time, $date)
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

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

    public function SetExamPersonConnect($userId, $examId, $remainingTime, $status)
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

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

    public function SetQuestions($examId, $question, $questionType, $order, $image)
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

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

    public function SetQuestionOptions($questionId, $answer, $orderNumber)
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

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $parameters);
    }

    public function SetExamResultReadingReply($list)
    {
        $endpoint = "ExamSystem/SetExamResultReadingReply";
        $headers = [
            'Authorization' => 'Bearer ' . $this->_token,
        ];

        return $this->callApi($this->baseUrl . $endpoint, 'post', $headers, $list);
    }
}
