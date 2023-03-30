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
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function GetExamEdit(
        int $examId
    ): ServiceResponse;

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function GetQuestionsEdit(
        int $questionId
    ): ServiceResponse;

    /**
     * @param int $questionOptionId
     *
     * @return ServiceResponse
     */
    public function GetQuestionOptionsEdit(
        int $questionOptionId
    ): ServiceResponse;

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
    ): ServiceResponse;

    /**
     * @param int $examId
     *
     * @return ServiceResponse
     */
    public function SetExamDelete(
        int $examId
    ): ServiceResponse;

    /**
     * @param int $questionId
     *
     * @return ServiceResponse
     */
    public function SetQuestionsDelete(
        int $questionId
    ): ServiceResponse;

    /**
     * @param int $questionOptionId
     *
     * @return ServiceResponse
     */
    public function SetQuestionOptionsDelete(
        int $questionOptionId
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
     * @param int|null $id
     * @param int $examId
     * @param string $question
     * @param int $questionType
     * @param int $order
     * @param string|null $image
     *
     * @return ServiceResponse
     */
    public function SetQuestions(
        int|null    $id,
        int         $examId,
        string      $question,
        int         $questionType,
        int         $order,
        string|null $image = null
    ): ServiceResponse;

    /**
     * @param mixed $id
     * @param int $questionId
     * @param string $answer
     * @param int $order
     *
     * @return ServiceResponse
     */
    public function SetQuestionOptions(
        mixed $id,
        int        $questionId,
        string     $answer,
        int        $order
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
