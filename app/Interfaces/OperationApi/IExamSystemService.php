<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface IExamSystemService
{
    /**
     * @return ServiceResponse
     */
    public function GetExamList();

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamPersonConnectList(
        int $examId
    );

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetQuestionsList(
        int $examId
    );

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetQuestionOptionsList(
        int $questionId
    );

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultReadingList(
        int $examId
    );

    /**
     * @param int $id
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultReadingReplyList(
        int $id,
        int $examId
    );

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultList(
        int $examId
    );

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
    );

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
    );

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
    );

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
    );

    /**
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function SetExamResultReadingReply(
        array $list
    );
}
