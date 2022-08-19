<?php


namespace App\Interfaces\OperationApi;

use App\Services\ServiceResponse;

interface IExamSystemService
{
    /**
     * @return ServiceResponse
     */
    public function GetExamList(): ServiceResponse;

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamPersonConnectList(
        int $examId
    ): ServiceResponse;

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetQuestionsList(
        int $examId
    ): ServiceResponse;

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetQuestionOptionsList(
        int $questionId
    ): ServiceResponse;

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultReadingList(
        int $examId
    ): ServiceResponse;

    /**
     * @param int $employeeGuid
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultReadingReplyList(
        int $employeeGuid,
        int $examId
    ): ServiceResponse;

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamResultList(
        int $examId
    ): ServiceResponse;

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
    ): ServiceResponse;

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
    ): ServiceResponse;

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
    ): ServiceResponse;

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
    ): ServiceResponse;

    /**
     * @param array $list
     *
     * @return ServiceResponse
     */
    public function SetExamResultReadingReply(
        array $list
    ): ServiceResponse;
}
